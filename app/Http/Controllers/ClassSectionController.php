<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSection;
use App\Models\Section;
use App\Models\Teacher;
use App\Http\Requests\StoreClassSectionRequest;
use App\Http\Requests\UpdateClassSectionRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ClassSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        if (!Gate::allows('viewAny', ClassSection::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403);
        }

        $classes = ClassSection::all();
        $sections = Section::all();

        return view('classes.index', ['classSections' => $classes, 'sections' => $sections]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        if (!Gate::allows('create', ClassSection::class)) {
            // Retourne une erreur 403 (accès interdit)
            abort(403);
        }

        $sections = Section::all();
        $teachers = Teacher::all();
        $classes = ClassSection::all();

        return view('classes.create', ['sections' => $sections, 'teachers' => $teachers, 'classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassSectionRequest $request)
    {
        // Faire la validation
        $validatedData = $request->validated();

        // Générer le nom de la classe en fonction de la section sélectionnée
        $name = '';
        $selectedSection = Section::find($validatedData['section_id']);
        if ($selectedSection) {
            $classCounter = ClassSection::where('section_id', $selectedSection->id)->count();
            switch ($selectedSection->name) {
                case 'Accueil':
                    $name = 'ACC-' . chr(65 + $classCounter);
                    break;
                case 'Petite Section':
                    $name = '1-MAT-' . chr(65 + $classCounter);
                    break;
                case 'Moyenne Section':
                    $name = '2-MAT-' . chr(65 + $classCounter);
                    break;
                case 'Grande Section':
                    $name = '3-MAT-' . chr(65 + $classCounter);
                    break;
                default:
                    $name = '';
            }
        }

        try {
            // Créer une nouvelle classe
            $class = new ClassSection();
            $class->name = $name;
            $class->section_id = $validatedData['section_id'];
            $class->teacher_id = $validatedData['teacher_id'];
            $class->school_year = $validatedData['school_year'];
            $class->save();

            // Redirection avec un message de succès
            return redirect()->route('classes.index')->with('success', 'Classe ajouté avec succès.');
        } catch (\Exception $e) {
            // Log des erreurs pour le débogage
            \Log::error('Erreur lors de l\'ajout de l\'enseignant: '.$e->getMessage());
            // Redirection avec un message d'erreur
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout de l\'enseignant. Veuillez réessayer.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = ClassSection::findOrFail($id);

        return view('classes.show', ['class' => $class]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = ClassSection::findOrFail($id);

        if (!Gate::allows('update', $class)) {
            // Retourne une erreur 403 (accès interdit)
            abort(403);
        }

        $sections = Section::all();
        $teachers = Teacher::all();

        return view('classes.edit', ['class' => $class, 'sections' => $sections, 'teachers' => $teachers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassSectionRequest $request, string $id)
    {
        $class = ClassSection::findOrFail($id);

        if (!Gate::allows('update', $class)) {
            // Retourne une erreur 403 (accès interdit)
            abort(403);
        }

        $validatedData = $request->validated();

        $name = '';
        $selectedSection = Section::find($validatedData['section_id']);
        if ($selectedSection) {
            $classCounter = ClassSection::where('section_id', $selectedSection->id)->count();
            switch ($selectedSection->name) {
                case 'Accueil':
                    $name = 'ACC-' . chr(65 + $classCounter);
                    break;
                case 'Petite Section':
                    $name = '1-MAT-' . chr(65 + $classCounter);
                    break;
                case 'Moyenne Section':
                    $name = '2-MAT-' . chr(65 + $classCounter);
                    break;
                case 'Grande Section':
                    $name = '3-MAT-' . chr(65 + $classCounter);
                    break;
                default:
                    $name = '';
            }
        }
    
        $class->section_id = $validatedData['section_id'];
        $class->teacher_id = $validatedData['teacher_id'];
        $class->school_year = $validatedData['school_year'];
        $class->name = $name;
        $class->push();
    
        return redirect()->route('classes.index')->with('success', 'Classe mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = ClassSection::findOrFail($id);

        if (!Gate::allows('delete', $class)) {
            // Retourne une erreur 403 (accès interdit)
            abort(403);
        }

        if($class) {
            $class->delete();
        }

        // Rediriger avec un message de succès
        return redirect()->route('classes.index')->with('success', 'Classe supprimée avec succès.');
    }

    public function showByClass()
    {
        $user = Auth::user();

        if ($user->role_id === 2) {
            // Récupérer l'ID de la classe enseignée par l'enseignant
            $classSectionId = $user->teacher->classSection->id;
            // Rechercher la classe en utilisant l'ID
            $class = ClassSection::findOrFail($classSectionId);
            return view('classes.show', ['class' => $class]);
        } elseif ($user->role_id === 3) {
            // Récupérer les IDs de classe de tous les enfants du parent (tuteur)
            $children = $user->tutor->children;
            $classSectionIds = $children->pluck('class_id')->unique()->toArray();
            // Rechercher les classes en utilisant les IDs
            $classSections = ClassSection::whereIn('id', $classSectionIds)->get();
            return view('classes.show', ['classSections' => $classSections]);
        } else {
            // Rediriger ou afficher une erreur pour d'autres rôles non traités
            return redirect()->route('home')->with('error', 'Vous n\'avez pas la permission d\'accéder à cette page.');
        }

    }
}
