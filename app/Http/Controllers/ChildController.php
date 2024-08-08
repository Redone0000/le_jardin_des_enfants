<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\ClassSection;
use App\Models\Section;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Tutor;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Gate::allows('viewAny', Child::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403);
        }

        $query = Child::query()->filterByUserRole();

        // Recherche par nom
        if ($request->has('search') && $request->input('search')) {
            $query->where('lastname', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('firstname', 'like', '%' . $request->input('search') . '%');
        }

        // Tri par classe
        if ($request->has('sort') && $request->input('sort')) {
            $query->where('class_id', $request->input('sort'));
        }

        $children = $query->get();
        // $children = Child::all();
        $classes = ClassSection::all();

        return view('children.index', ['children' => $children, 'classes' => $classes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        if (!Gate::allows('create', Child::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403);
        }

        $classes = ClassSection::all();
        $sections = Section::all();
        return view('children.create', ['classes' => $classes, 'sections' => $sections]);
    }

    public function store(StoreChildRequest $request)
    {   
        if (!Gate::allows('create', Child::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403);
        }
        // Valider les données et obtenir les données validées
        $validatedData = $request->validated();

        // Trouver la classe
        $class = ClassSection::findOrFail($validatedData['classe']);

        // Générer le login
        $userLogin = strtolower($validatedData['lastname_tutor'] . '_' . $validatedData['firstname_tutor']);

        // Générer le mot de passe aléatoire
        $password = Str::random(10);

        // Sauvegarder l'image
        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture')->store('children', 'public');
        } else {
            $imagePath = null;
        }

        // Créer l'utilisateur parent (tuteur)
        $user = new User();
        $user->login = $userLogin;
        $user->lastname = ucwords(strtolower($validatedData['lastname_tutor']));
        $user->firstname = ucwords(strtolower($validatedData['firstname_tutor']));
        $user->email = $validatedData['email'];
        $user->password = bcrypt($password); // Assurez-vous de hasher le mot de passe
        $user->phone = $validatedData['phone'];
        $user->role_id = $validatedData['role_id']; // Assurez-vous que cela est correct
        $user->save();

        // Créer le tuteur associé
        $tutor = new Tutor();
        $tutor->user_id = $user->id;
        $tutor->address = $validatedData['address'];
        $tutor->emergency_contact_name = $validatedData['emergency_contact_name'];
        $tutor->emergency_contact_phone = $validatedData['emergency_contact_phone'];
        $tutor->save();

        // Créer l'enfant
        $child = new Child();
        $child->class_id = $validatedData['classe'];
        $child->lastname = ucwords(strtolower($validatedData['lastname']));
        $child->firstname = ucwords(strtolower($validatedData['firstname']));
        $child->sexe = $validatedData['sexe'];
        $child->birth_date = $validatedData['birth_date'];
        $child->picture = $imagePath;
        $child->tutor_id = $tutor->id;
        $child->save();

        // Redirection avec un message de succès
        return redirect()->route('children.index')->with('success', 'Enfant ajouté avec succès.');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $child = Child::findOrFail($id);
        // Vérifie si l'utilisateur actuel est autorisé à voir le profil de l'enfant
        if (!Gate::allows('view', $child)) {
            abort(403); // Interdit l'accès si l'utilisateur n'a pas la permission
        }

        return view('children.show', ['child' => $child]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $child = Child::with('classe')->find($id);

        // Vérifie si l'utilisateur actuel est autorisé à voir le profil de l'enfant
        // if (!Gate::allows('update', $child)) {
        //     abort(403);
        // }

        $classes = ClassSection::all();

        return view('children.edit', ['child' => $child, 'classes' => $classes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildRequest $request, string $id)
    {
        $child = Child::findOrFail($id);
        
        // Vérifie si l'utilisateur actuel est autorisé à voir le profil de l'enfant
        // if (!Gate::allows('update', $child)) {
        //     abort(403);
        // }

        // $request->validate([
        //     'classe' => 'required|integer',
        //     'lastname' => 'required|string',
        //     'firstname' => 'required|string',
        //     'sexe' => 'required|in:Male,Female',
        //     'birth_date' => 'nullable|date',
        //     'picture' => ['nullable', 'image', 'mimetypes:image/jpeg,image/png,image/jpg,image/gif', 'max:2048'],
        //     'firstname_tutor' => ['required', 'string', 'max:255'],
        //     'lastname_tutor' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255'],
        //     'phone' => ['required', 'string', 'max:255'],
        //     'address' => ['required', 'string', 'max:255'],
        //     'emergency_contact_name' => ['required', 'string', 'max:255'],
        //     'emergency_contact_phone' => ['required', 'string', 'max:255'],
        // ]);

        // Mettre à jour les champs du modèle Child avec les données du formulaire
        $child->class_id = $request->classe;
        $child->lastname = $request->lastname;
        $child->firstname = $request->firstname;
        $child->sexe = $request->sexe;
        $child->birth_date = $request->birth_date;
        $child->tutor->user->firstname = $request->firstname_tutor;
        $child->tutor->user->lastname = $request->lastname_tutor;
        $child->tutor->user->email = $request->email;
        $child->tutor->user->phone = $request->phone;
        $child->tutor->address = $request->address;
        $child->tutor->emergency_contact_name = $request->emergency_contact_name;
        $child->tutor->emergency_contact_phone = $request->emergency_contact_phone;

        // Sauvegarde des changements sur le tuteur (User)
        $child->tutor->user->save();

        // Sauvegarde des changements sur le tuteur (Tutor)
        $child->tutor->save();

        if ($request->hasFile('picture')) {
            // Suppression de l'ancienne photo si l'utilisateur a entré une nouvelle photo
            if ($child->picture) {
                Storage::disk('public')->delete($child->picture);
            }
            // Sauvegarde de la nouvelle photo
            $imagePath = $request->file('picture')->store('pictures', 'public');
            $child->picture = $imagePath;
        }

        $child->save();

        return redirect()->route('child.show', ['id' => $child->id])->with('success', 'Enfant mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::allows('viewAny', Child::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403);
        }

        $child = Child::findOrFail($id);

        if($child) {
            $child->delete();
        }

        return redirect()->route('children.index')->with('success', 'Opération effectuée avec succès.');
    }
}
