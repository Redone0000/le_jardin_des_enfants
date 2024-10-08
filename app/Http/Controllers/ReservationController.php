<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Payment;
use App\Models\Child;
use App\Models\Menu;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user(); // Récupère l'utilisateur authentifié
        $search = $request->input('search');
    
        // Récupère les réservations en fonction du rôle de l'utilisateur
        $reservationsQuery = Reservation::getReservationsForUserQuery($user);
    
        // Récupère les réservations avec pagination
        $reservations = $reservationsQuery;
    
        return view('reservations.index', compact('reservations'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'month' => 'required|string',
            'price' => 'required|numeric',
            'child_id' => 'required|exists:children,id',
            'action' => 'required|string|in:pay_now,pay_later', // Validation de l'action
        ]);

        // Vérifier si une réservation existe déjà pour cet enfant pour ce mois
        $existingReservation = Reservation::where('child_id', $validatedData['child_id'])
            ->where('month', $validatedData['month'])
            ->first();

        if ($existingReservation) {
            return redirect()->back()->with('error', 'Une réservation existe déjà pour cet enfant pour ce mois.');
        }

        // Créer une nouvelle réservation
        $reservation = Reservation::create([
            'menu_id' => $validatedData['menu_id'],
            'month' => $validatedData['month'],
            'price' => $validatedData['price'],
            'child_id' => $validatedData['child_id'],
            'status' => $request->input('action') === 'pay_later' ? 'pending' : 'unpaid', // Statut basé sur l'action
        ]);

        if ($request->input('action') === 'pay_now') {
            // Gérer le paiement immédiat avec Stripe
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $validatedData['month'],
                        ],
                        'unit_amount' => $validatedData['price'] * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', ['reservation_id' => $reservation->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
            ]);

            // Vérifiez l'existence avant de créer un paiement
            // $existingPayment = Payment::where('stripe_payment_id', $session->id)->first();

            // if (!$existingPayment) {
                // Créer l'enregistrement du paiement
                Payment::create([
                    'reservation_id' => $reservation->id,
                    'stripe_payment_id' => $session->id,
                    'amount' => $validatedData['price'],
                    'currency' => 'eur',
                    'status' => 'pending',
                ]);
            // }

            return redirect()->away($session->url);
        }

        return redirect()->route('menus.next_menus')->with('success', 'Réservation confirmée, paiement à faire plus tard.');
    }

    public function paymentSuccess(Request $request, $reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        $reservation->update(['status' => 'paid']);

        $payment = Payment::where('reservation_id', $reservation_id)->first();

        $stripeSessionId = $request->get('session_id');

        if(!$stripeSessionId) {
            return redirect()->route('menus.next_menus')->with('error', 'Session ID manquant pour le paiement');
        };

        if($payment) {
            $payment->update([
                'status' => 'paid',
                'stripe_payment_id' => $stripeSessionId
            ]);
        } else {
            return redirect()->route('menus.next_menus')->with('error', 'Paiement non trouvé');
        }

        return redirect()->route('menus.next_menus')->with('success', 'Paiement réussi');
    }

    public function paymentCancel()
    {
        return redirect()->route('menus.next_menus')->with('error', 'Le paiement a été annulé');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    public function pay($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Vérifier si la réservation est bien en statut "pending"
        if ($reservation->status !== 'pending') {
            return redirect()->back()->with('error', 'Cette réservation a déjà été payée ou annulée.');
        }

        // Processus de paiement Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $reservation->month,
                    ],
                    'unit_amount' => $reservation->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['reservation_id' => $reservation->id]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
        ]);

        // Créer l'enregistrement du paiement avec le statut "pending"
        Payment::create([
            'reservation_id' => $reservation->id,
            'stripe_payment_id' => $session->id,
            'amount' => $reservation->price,
            'currency' => 'eur',
            'status' => 'pending',
        ]);

        return redirect()->away($session->url);
    }
}
