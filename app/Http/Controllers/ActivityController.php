<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\ActivityData;
use App\Models\ClassSection;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use Illuminate\Support\Facades\Gate;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        if (!Gate::allows('viewAny', Activity::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }

        $user = Auth::user();
        $query = Activity::query()->forUser($user);

        // Recherche par nom
        if ($request->has('search') && $request->input('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('description', 'like', '%' . $request->input('search') . '%');
            });
        }

        // Tri par classe
        if ($request->has('sort') && $request->input('sort')) {
            $query->where('class_id', $request->input('sort'));
        }

        // Tri par type
        if ($request->has('sortType') && $request->input('sortType')) {
            $query->where('activity_type_id', $request->input('sortType'));
        }
        // Filtre par catégorie 
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('activityType', function ($q) use ($request) {
                $q->where('category', $request->category);
            });
        }
        $activities = $query->get();
        $activityTypes = ActivityType::all();
        $classes = ClassSection::all();
        $types = ActivityType::all();
        $categories = ActivityType::select('category')->distinct()->get();

        return view('activities.index', compact('activities', 'activityTypes', 'classes', 'types', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        if (!Gate::allows('create', Activity::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }
        
        $classes = ClassSection::all();
        $types = ActivityType::all();

        return view('activities.create', compact('classes', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityRequest $request)
    {   
        if (!Gate::allows('create', Activity::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }

        $validatedData = $request->validated();
        
        // Créer une nouvelle activité
        $activity = new Activity();
        // $activity->class_id = $request->classe;
        $activity->class_id = $validatedData['classe'];
        $activity->activity_type_id = $validatedData['type'];
        $activity->title = $validatedData['name'];
        $activity->description = $validatedData['description'];
        $activity->save();
        

        // Enregistrer les fichiers dans la table DataActivity
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $picture) {
                $this->storeFile($picture, $activity->id, 'photo');
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $this->storeFile($video, $activity->id, 'video');
            }
        }

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $pdf) {
                $this->storeFile($pdf, $activity->id, 'pdf');
            }
        }

        return redirect()->route('activity.index')->with('success', 'Activité créée avec succès.');
    }

    private function storeFile($file, $activityId, $type)
    {
        // Enregistrer le fichier dans le système de fichiers
        $filePath = $file->store('activity', 'public');

        // Enregistrer le chemin du fichier dans la base de données
        ActivityData::create([
            'activity_id' => $activityId,
            'type' => $type,
            'file_path' => $filePath,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   

        $activity = Activity::findOrFail($id);

        if (!Gate::allows('view', $activity)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }

        return view('activities.show', ['activity' => $activity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupérer l'activité par son ID
        $activity = Activity::findOrFail($id);
        $classes = ClassSection::all();
        $types = ActivityType::all();

        // Passer l'activité à la vue d'édition
        return view('activities.edit', compact('activity', 'types', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, string $id)
    {
        // Récupérer l'activité à mettre à jour
        $activity = Activity::findOrFail($id);

        $validatedData = $request->validated();

        // Mettre à jour les champs de l'activité
        $activity->class_id = $validatedData['classe'];
        $activity->activity_type_id = $validatedData['type'];
        $activity->title = $validatedData['name'];
        $activity->description = $validatedData['description'];

        // Enregistrer les modifications
        $activity->save();

       // Enregistrer les fichiers dans la table DataActivity
       if ($request->hasFile('pictures')) {
        foreach ($request->file('pictures') as $picture) {
            $this->storeFile($picture, $activity->id, 'photo');
        }
    }

    if ($request->hasFile('videos')) {
        foreach ($request->file('videos') as $video) {
            $this->storeFile($video, $activity->id, 'video');
        }
    }

    if ($request->hasFile('pdfs')) {
        foreach ($request->file('pdfs') as $pdf) {
            $this->storeFile($pdf, $activity->id, 'pdf');
        }
    }


        // Rediriger avec un message de succès
        return redirect()->route('activity.index')->with('success', 'Activité mise à jour avec succès.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);

        if($activity) {
            $activity->delete();
        }
        // Rediriger avec un message de succès
        return redirect()->route('activity.index')->with('success', 'Activité supprimée avec succès.');
    }


    // public function feed()
    // {
    //    // Récupérer l'utilisateur connecté
    //     $user = auth()->user();

    //     if ($user->role_id === 1) {
    //         // Pour un administrateur, récupérer toutes les activités
    //         $activities = Activity::with(['activityData', 'comments'])
    //             ->orderBy('created_at', 'desc')
    //             ->get();
    //     } elseif ($user->role_id === 2) {
    //         // Pour un enseignant, récupérer les activités liées à sa classe
    //         $activities = Activity::where('class_id', $user->teacher->classSection->id)
    //             ->with(['activityData', 'comments'])
    //             ->orderBy('created_at', 'desc')
    //             ->get();
    //     } elseif ($user->user_id === 3) {
    //         // Pour un parent, récupérer les activités liées aux enfants sous sa responsabilité
    //         $childClassIds = $user->tutor->children->pluck('class_id');
    //         $activities = Activity::whereIn('class_id', $childClassIds)
    //             ->with(['activityData', 'comments'])
    //             ->orderBy('created_at', 'desc')
    //             ->get();
    //     } else {

    //         $activities = collect();
    //     }

    //     // Retourner la vue avec les activités filtrées
    //     return view('activities.feed', compact('activities'));
    // }

    public function feed()
{
    // Récupérer l'utilisateur connecté
    $user = auth()->user();

    if ($user->role_id === 1) {
        // Pour un administrateur, récupérer toutes les activités
        $activities = Activity::with(['activityData', 'comments'])
            ->orderBy('created_at', 'desc')
            ->get();
    } elseif ($user->role_id === 2) {
        // Pour un enseignant, récupérer les activités liées à sa classe
        $activities = Activity::where('class_id', $user->teacher->classSection->id)
            ->with(['activityData', 'comments'])
            ->orderBy('created_at', 'desc')
            ->get();
    } elseif ($user->role_id === 3) {
        // Pour un parent, récupérer les activités liées aux enfants sous sa responsabilité
        $childClassIds = $user->tutor->children->pluck('class_id');
        $activities = Activity::whereIn('class_id', $childClassIds)
            ->with(['activityData', 'comments'])
            ->orderBy('created_at', 'desc')
            ->get();
    } else {
        // Gérer les autres types d'utilisateurs si nécessaire
        $activities = collect();
    }

    // Retourner la vue avec les activités filtrées
    return view('activities.feed', compact('activities'));
}
}
