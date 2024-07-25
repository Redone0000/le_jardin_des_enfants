<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\ClassSection;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreActivityRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
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
        $activities = $query->get();
        $activityTypes = ActivityType::all();
        $classes = ClassSection::all();
        $types = ActivityType::all();

        return view('activities.index', compact('activities', 'activityTypes', 'classes', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $classes = ClassSection::all();
        $types = ActivityType::all();

        return view('activities.create', compact('classes', 'types'));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //            // Obtenez le nom de la table pour ce modèle
    //    $instance = new $model();
    //    $tableName = $instance->getTable();
   
    //    // Obtenez les informations sur les colonnes de cette table
    //    $columns = Schema::getColumnListing($tableName);
    //    $columnsInfo = [];
   
    //    foreach ($columns as $column) {
    //        $columnInfo = Schema::getColumnType($tableName, $column);
    //        $columnsInfo[$column] = $this->parseColumnType($columnInfo);
    //    }
   
    //    return $columnsInfo;
    // }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityRequest $request)
    {    
        // $request->validate([
        //     'classe' => 'required',
        //     'type' => 'required',
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string',
        // ]);
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
        DataActivity::create([
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
