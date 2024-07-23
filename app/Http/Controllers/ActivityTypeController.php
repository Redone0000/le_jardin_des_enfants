<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreActivityTypeRequest;
use App\Http\Requests\UpdateActivityTypeRequest;
use App\Models\ActivityType;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   

        // Récupérer les catégories distinctes
        $categories = ActivityType::select('category')->distinct()->get();

        // $activityTypes = ActivityType::all();

        // return view('activityTypes.index', compact('activityTypes', 'categories'));
        // Créer la requête de base pour les types d'activité
    $query = ActivityType::query();

    // Appliquer le filtre de recherche par nom
    if ($request->has('search') && !empty($request->search)) {
        $query->where('name', 'like', '%' . $request->search . '%')
        ->orWhere('description', 'like', '%' . $request->input('search') . '%');
    }

    // Appliquer le filtre de catégorie
    if ($request->has('sort') && !empty($request->sort)) {
        $query->where('category', $request->sort);
    }

    // Récupérer les résultats paginés
    $activityTypes = $query->paginate(10);

    // Passer les catégories et les résultats à la vue
    return view('activity-types.index', compact('activityTypes', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activityTypes = ActivityType::all();

        return view('activity-types.create', compact('activityTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityTypeRequest $request)
    {
        // Création d'un nouvel enregistrement
        ActivityType::create([
            'category' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirection avec message de succès
        return redirect()->route('activity-types.index')->with('success', 'Activité créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         // Trouver l'enregistrement par ID
         $activityType = ActivityType::findOrFail($id);

         // Retourner la vue avec les données de l'activité
         return view('activity-types.show', compact('activityType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Trouver l'enregistrement par ID
        $activityType = ActivityType::findOrFail($id);

        // Retourner la vue avec les données de l'activité
        return view('activity-types.edit', compact('activityType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityTypeRequest  $request, $id)
    {
        // Trouver l'enregistrement par ID
        $activityType = ActivityType::findOrFail($id);

        // Mettre à jour l'enregistrement
        $activityType->update([
            'category' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirection avec message de succès
        return redirect()->route('activity-types.index')->with('success', 'Activité mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trouver l'enregistrement par ID
        $activityType = ActivityType::findOrFail($id);

        // Supprimer l'enregistrement
        $activityType->delete();

        // Redirection avec message de succès
        return redirect()->route('activity-types.index')->with('success', 'Activité supprimée avec succès.');
    }
}
