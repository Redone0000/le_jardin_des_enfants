<?php

namespace App\Http\Controllers;

use App\Mail\UserNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class MailController extends Controller
{
    /**
     * Envoie un email aux administrateurs.
     */
    public function sendMailToAdmins(Request $request)
    {
        // Récupérer le sujet et le contenu du message depuis la requête
        $subject = $request->input('subject');
        $content = $request->input('content');
        $nameSender = $request->input('nameSender');
        $emailSender = $request->input('email');

        // dd($request->all());
        
        // Récupérer tous les utilisateurs avec le rôle d'administrateur (role_id = 1)
        $admins = User::where('role_id', 1)->get();

        // Envoyer un email à chaque administrateur
        foreach ($admins as $admin) {
            $name = $admin->firstname . ' ' . $admin->lastname;
            $email = $admin->email;

            // Envoyer l'email
            Mail::to($email)->send(new UserNotificationMail(
                $name,       // Nom de l'admin
                $emailSender,      // Email de l'admin
                $subject,    // Sujet de l'email
                $content,    // Contenu de l'email
                $nameSender,
            ));
        }

        // // Rediriger avec un message de succès
        return back()->with('success', 'Emails envoyés aux administrateurs.');
    }
}
