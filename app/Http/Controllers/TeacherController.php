<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Http\Requests\StoreTeacherRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $order = $request->input('order'); 

        $query = Teacher::with('user');

        if ($search) {
            $query->whereHas('user', function($query) use ($search) {
                $query->where('firstname', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%');
            });
        }

        $teachers = $query->get();

        return view('teachers.index', ['teachers' => $teachers]);
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
            $imagePath = $request->file('picture')->store('pictures_teacher', 'public');
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
    public function show($id)
    {   
            // Trouver l'enseignant par ID
    $teacher = Teacher::find($id);

    if (!$teacher) {
        return redirect()->route('teacher.index')->with('error', 'L\'enseignant demandé n\'existe pas.');
    }

    // Si trouvé, afficher la vue du profil de l'enseignant
    return view('teachers.show', ['teacher' => $teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = User::findOrFail($id);
        $t = $teacher->teacher;

        // if (!Gate::allows('update', $t)) {
        //     // L'utilisateur actuel n'a pas la permission de voir le profil de l'enseignant
        //     abort(403);
        // }

        return view('teachers.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Récuperer l'enseignant
        $teacher = User::findOrFail($id);
        $t = $teacher->teacher;

        if (!Gate::allows('update', $t)) {
            // L'utilisateur actuel n'a pas la permission de voir le profil de l'enseignant
            abort(403);
        }
        
        // Validation des données
        $request->validate([
            'login' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($teacher->id)],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'], 
            'picture' => ['nullable', 'image', 'mimetypes:image/jpeg,image/png,image/jpg,image/gif', 'max:2048'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $firstname = ucwords(strtolower($request->firstname));
        $lastname = ucwords(strtolower($request->lastname));

        // Handle the image upload
        if ($request->hasFile('picture')) {
            // Suppression de l'ancienne photo si l'utilisateur a entré une nouvelle photo
            if ($teacher->teacher->picture) {
                Storage::disk('public')->delete($teacher->teacher->picture);
            }
            // Sauvegarde de la nouvelle photo
            $imagePath = $request->file('picture')->store('pictures', 'public');
            $teacher->teacher->picture = $imagePath;
        }

        // Mise à jour des autres champs
        $teacher->login = $request->login;
        $teacher->firstname = $firstname;
        $teacher->lastname = $lastname;
        $teacher->phone = $request->phone;
        
        if ($request->filled('password')) {
            $teacher->password = bcrypt($request->password);
        }
        
        $teacher->teacher->description = $request->description;

        // Save the changes
        $teacher->push(); // This will save the teacher and its related teacher record

        return redirect()->route('teacher.show', ['id' => $teacher->teacher->id] )->with('success', 'Opération réussie !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $teacher = Teacher::findOrFail($id);
        // Vérifier si l'utilisateur a la permission de supprimer cet enseignant
        if (!Gate::allows('delete', $teacher)) {
            abort(403, 'Vous n\'avez pas la permission de supprimer cet enseignant.');
        }
        if($teacher) {
            $teacher->delete();
        }

        return redirect()->route('teacher.index')->with('error', 'Enseignant supprimé avec succès.');
    }
}
