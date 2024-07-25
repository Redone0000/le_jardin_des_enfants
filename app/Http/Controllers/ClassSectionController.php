<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSection;
use App\Models\Section;
use App\Models\Teacher;

class ClassSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassSection::all();
        $sections = Section::all();

        return view('classes.index', ['classSections' => $classes, 'sections' => $sections]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        $teachers = Teacher::all();
        $classes = ClassSection::all();

        return view('classes.create', ['sections' => $sections, 'teachers' => $teachers, 'classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Faire la validation
        $request->validate([
            'section_id' => ['required', 'exists:sections,id'],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'school_year' => ['required', 'string'],
        ]);
        // dd($request->all());
        // Générer le nom de la classe en fonction de la section sélectionnée
        $name = '';
        $selectedSection = Section::find($request->section_id);
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
            $class->section_id = $request->section_id;
            $class->teacher_id = $request->teacher_id;
            $class->school_year = $request->school_year;
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

        // if (!Gate::allows('update', $class)) {
        //     // Retourne une erreur 403 (accès interdit)
        //     abort(403);
        // }

        $sections = Section::all();
        $teachers = Teacher::all();

        return view('classes.edit', ['class' => $class, 'sections' => $sections, 'teachers' => $teachers]);
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
