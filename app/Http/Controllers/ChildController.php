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

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {   
    //     // Autorisation + validation
    //     $validatedData = $request->validated();

    //     $classe = ClassSection::findOrFail($request->classe);
    //     // un login
    //     $userLogin = strtolower($request->lastname_tutor . '_' . $request->firstname_tutor);

    //     // mot de passe 
    //     $password = Str::random(10);

    //     // Sauvegarder l'image
    //     if ($request->hasFile('picture')) {
    //         $imagePath = $request->file('picture')->store('children', 'public');
    //     } else {
    //         $imagePath = null;
    //     }

    //     $user = new User();
    //     $user->login = $userLogin;
    //     $user->lastname = ucwords(strtolower($request->lastname_tutor));
    //     $user->firstname = ucwords(strtolower($request->firstname_tutor));
    //     $user->email = $request->email;
    //     $user->password = $password;
    //     $user->phone = $request->phone;
    //     $user->role_id = $request->role_id;
    //     $user->save();

    //     $tutor = new Tutor();
    //     $tutor->user_id = $user->id;
    //     $tutor->address = $request->address;
    //     $tutor->emergency_contact_name = $request->emergency_contact_name;
    //     $tutor->emergency_contact_phone = $request->emergency_contact_phone;
    //     $tutor->save();

    //     $child = new Child();
    //     $child->class_id = $request->classe;
    //     $child->lastname = ucwords(strtolower($request->lastname));
    //     $child->firstname = ucwords(strtolower($request->firstname));
    //     $child->sexe = $request->sexe;
    //     $child->birth_date = $request->birth_date;
    //     $child->picture = $imagePath;
    //     $child->tutor_id = $tutor->id;
    //     $child->save();



    //     // Mail::to($user->email)->send(new RegisterMail($request->all(), $password, $classe->name));
    
    //     return redirect()->route('child.index')->with('success', $password);
    // }



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
