<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Http\Requests\StoreTeacherRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $teacher = Teacher::all();

        // return view('teachers.index', compact('teachers'));
        return view('teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreTeacherRequest $request)
    // {
    //     // Les données validées sont automatiquement disponibles
    //     $validated = $request->validated();

    //     try {
            
    //         $firstname = ucwords(strtolower($request->firstname));
    //         $lastname = ucwords(strtolower($request->lastname));

    //         $userLogin = strtolower($request->lastname . '_' . $request->firstname);
    //         $password = Str::random(10);

    //         $user = new User();
    //         $user->login = $userLogin;
    //         $user->lastname = $request->lastname;
    //         $user->firstname = $request->firstname;
    //         $user->email = $request->email;
    //         $user->password = $password;
    //         $user->phone = $request->phone;
    //         $user->role_id = $request->role_id;
    //         $user->save();
            
    //         // Sauvegarder l'image
    //         if ($request->hasFile('picture')) {
    //             $imagePath = $request->file('picture')->store('pictures', 'public');
    //         } else {
    //             $imagePath = null;
    //         }

    //         $teacher = new Teacher();
    //         $teacher->user_id = $user->id;
    //         $teacher->picture = $imagePath;
    //         $teacher->description = $request->description;
    //         $teacher->save();
            
    //         // Faire un autre mailer ??? car different de celui pour tutor
    //         // Mail::to($user->email)->send(new TeacherRegisterMail($request->all(), $userLogin, $password));
    
    //         return redirect()->route('teacher.index')->with('success', $password);

    //         // return redirect()->route('teacher.index')->with('success', 'Enseignant ajouté avec succès.');

    //     } catch (\Exception $e) {
    //         // Log des erreurs pour le débogage
    //         \Log::error('Erreur lors de la création de l\'enseignant: '.$e->getMessage());
    //         // Redirection avec un message d'erreur
    //         return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la création de l\'enseignant. Veuillez réessayer.');
    //     }
    // }

    public function store(StoreTeacherRequest $request)
{
    // Les données validées sont automatiquement disponibles
    $validated = $request->validated();

    // Commencer une transaction pour garantir l'intégrité des données
    DB::beginTransaction();

    try {
        // Formater les noms
        $firstname = ucwords(strtolower($validated['firstname']));
        $lastname = ucwords(strtolower($validated['lastname']));

        // Générer le login et le mot de passe
        $userLogin = strtolower($lastname . '_' . $firstname);
        $password = Str::random(10);

        // Créer l'utilisateur
        $user = new User();
        $user->login = $userLogin;
        $user->lastname = $lastname;
        $user->firstname = $firstname;
        $user->email = $validated['email'];
        $user->password = Hash::make($password); // Hacher le mot de passe
        $user->phone = $validated['phone'];
        $user->role_id = $validated['role_id'];
        $user->save();

        // Sauvegarder l'image
        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture')->store('pictures', 'public');
        } else {
            $imagePath = null;
        }

        // Créer le professeur
        $teacher = new Teacher();
        $teacher->user_id = $user->id;
        $teacher->picture = $imagePath;
        $teacher->description = $validated['description'];
        $teacher->save();

        // Envoyer un e-mail de bienvenue (désactivé pour l'instant)
        // Mail::to($user->email)->send(new TeacherRegisterMail($validated, $userLogin, $password));

        // Commit de la transaction
        DB::commit();

        return redirect()->route('teacher.index')->with('success', 'Enseignant ajouté avec succès. Mot de passe : ' . $password);

    } catch (\Exception $e) {
        // Rollback de la transaction en cas d'erreur
        DB::rollBack();

        // Log des erreurs pour le débogage
        \Log::error('Erreur lors de la création de l\'enseignant: ' . $e->getMessage());

        // Redirection avec un message d'erreur
        return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la création de l\'enseignant. Veuillez réessayer.');
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
