<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePartnerRequest;
use Illuminate\Support\Facades\Gate;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        if (!Gate::allows('viewAny', Partner::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }
        
        $partners = Partner::all();

        return view('partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        if (!Gate::allows('create', Partner::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }

        return view('partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        $validatedData = $request->validated();

        // Gestion de l'image
        if ($request->hasFile('picture')) {
            $validatedData['picture'] = $request->file('picture')->store('partners', 'public');
        }

        // Création du partenaire
        Partner::create($validatedData);

        // Rediriger avec un message de succès
        return redirect()->route('partners.index')->with('success', 'Partenaire ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        if (!Gate::allows('view', Partner::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }
         // Récupérer le partenaire par son ID, ou lancer une exception 404 si non trouvé
         $partner = Partner::findOrFail($id);

         // Passer le partenaire à la vue
         return view('partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer le partenaire par son ID, ou lancer une exception 404 si non trouvé
        $partner = Partner::findOrFail($id);

        // Passer le partenaire à la vue
        return view('partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'website' => 'nullable|url',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Récupérer le partenaire par son ID
        $partner = Partner::findOrFail($id);

        // Mettre à jour les détails du partenaire
        $partner->name = $request->input('name');
        $partner->description = $request->input('description');
        $partner->address = $request->input('address');
        $partner->phone = $request->input('phone');
        $partner->website = $request->input('website');

        // Gestion de l'image
        if ($request->hasFile('picture')) {
            $imageName = time() . '.' . $request->file('picture')->extension();
            $request->file('picture')->storeAs('partners', $imageName, 'public');
            $partner->picture = 'partners/' . $imageName;
        }

        $partner->save();

        // Rediriger avec un message de succès
        return redirect()->route('partners.show', $partner->id)
                         ->with('success', 'Partenaire mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trouver le partenaire
        $partner = Partner::findOrFail($id);

        // Supprimer l'image du stockage, si elle existe
        if ($partner->picture) {
            Storage::disk('public')->delete($partner->picture);
        }

        // Supprimer le partenaire de la base de données
        $partner->delete();

        // Rediriger avec un message de succès
        return redirect()->route('partners.index')->with('success', 'Partenaire supprimé avec succès.');
    }
}
