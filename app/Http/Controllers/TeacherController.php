<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use App\Mail\TeacherRegisterMail;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {           
        if (!Gate::allows('viewAny', Teacher::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }

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
        if (!Gate::allows('create', Teacher::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }

        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {   
        if (!Gate::allows('create', Teacher::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validated();

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

            Mail::to($user->email)->send(new TeacherRegisterMail($validated, $userLogin, $password));

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

    if (!Gate::allows('view', $teacher)) {
        // retourner une erreur 403 (accès interdit)
        abort(403, 'Accès non autorisé.');
    }

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
        $user = User::findOrFail($id);
        $teacher = $user->teacher;
// dd($teacher);
        // if (!Gate::allows('update', $teacher)) {
        //     // L'utilisateur actuel n'a pas la permission de voir le profil de l'enseignant
        //     abort(403);
        // }

        return view('teachers.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateTeacherRequest $request, string $id)
    public function update(UpdateTeacherRequest $request, string $id)
    {
        // Récupérer l'utilisateur
        $user = User::findOrFail($id);

        // Accéder au modèle Teacher associé
        $teacher = $user->teacher;

                if (!Gate::allows('update', $teacher)) {
                // L'utilisateur actuel n'a pas la permission de voir le profil de l'enseignant
                abort(403);
            }

        // Validation et autorisation sont déjà vérifiées par la FormRequest

        // Formatage des noms
        $firstname = ucwords(strtolower($request->firstname));
        $lastname = ucwords(strtolower($request->lastname));

        // Gestion de l'image
        if ($request->hasFile('picture')) {
            // Suppression de l'ancienne photo si elle existe
            if ($teacher->picture) {
                Storage::disk('public')->delete($teacher->picture);
            }
            // Sauvegarde de la nouvelle photo
            $imagePath = $request->file('picture')->store('pictures', 'public');
            $teacher->picture = $imagePath;
        }

        // Mise à jour des données du modèle User
        $user->login = $request->login;
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Mise à jour des données du modèle Teacher
        $teacher->description = $request->description;

        // Sauvegarde des modifications
        $user->save();
        $teacher->save(); // Assurez-vous de sauvegarder le modèle Teacher également

        // Rediriger avec un message de succès
        return redirect()->route('teacher.show', ['id' => $teacher->id])
                        ->with('success', 'Opération réussie !');
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
