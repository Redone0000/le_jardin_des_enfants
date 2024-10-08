<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Activity;
use App\Models\Child;
use App\Models\ClassSection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use Illuminate\Support\Facades\Gate;


class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index($activityId)
    // {
    //     // Récupérer l'activité en question
    //     $activity = Activity::findOrFail($activityId);
    
    //     $user = Auth::user();
        
    //     // Vérifiez le rôle de l'utilisateur
    //     if ($user->role_id === 1) {

    //     $children = Child::where('class_id', $activity->class_id)->get();
    //     } else {
    //         // Les enseignants voient seulement les enfants de leur propre classe
    //         $class = $user->teacher->classSection->id;
    //         $children = Child::where('class_id', $class)
    //             ->whereHas('evaluations', function ($query) use ($activityId) {
    //                 $query->where('activity_id', $activityId);
    //             })->get();
    //     }
    
    //     // Récupérer les évaluations pour cette activité spécifique
    //     $evaluations = Evaluation::where('activity_id', $activityId)
    //         ->with('child')
    //         ->get()
    //         ->keyBy('child_id');
    
    //     return view('evaluations.index', compact('activity', 'children', 'evaluations', 'user'));
    // }

    public function index($activityId)
    {   
        if (!Gate::allows('viewAny', Evaluation::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }
        // Récupérer l'activité en question
        $activity = Activity::findOrFail($activityId);

        $user = Auth::user();

        // Récupérer tous les enfants de la classe associée à l'activité
        if ($user->role_id === 1) {
            $children = Child::where('class_id', $activity->class_id)->get();
        } else {
            // Les enseignants voient les enfants de leur propre classe
            $class = $user->teacher->classSection->id;
            $children = Child::where('class_id', $class)->get();
        }

        // Récupérer les évaluations pour cette activité spécifique
        $evaluations = Evaluation::where('activity_id', $activityId)
            ->get()
            ->keyBy('child_id');

        return view('evaluations.index', compact('activity', 'children', 'evaluations', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($activity_id, $child_id)
    {   
        $activity = Activity::findOrFail($activity_id);
        $child = Child::findOrFail($child_id);

        if (!Gate::allows('create', Evaluation::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }

        // Vous ne récupérez pas ici les autres évaluations
        return view('evaluations.create', compact('activity', 'child'));
    }
    public function createForm($activityId)
    {   

        $activity = Activity::findOrFail($activityId);

        if (!Gate::allows('create', Evaluation::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }

        $children = Child::where('class_id', $activity->class_id)->get();

        $evaluations = Evaluation::where('activity_id', $activityId)->get()->keyBy('child_id');

        return view('evaluations.create-form', compact('activity', 'children', 'evaluations'));
    }

    // public function create($activityId)
    // {
    //     $activity = Activity::findOrFail($activityId);
    //     $children = Child::where('class_id', $activity->class_id)->get();
    
    //     return view('evaluations.create', compact('activity', 'children'));
    // }

    public function store(Request $request)
{
    $request->validate([
        'activity_id' => 'required|exists:activities,id',
        'child_id' => 'required|exists:children,id',
        'grade' => 'required|numeric|min:0|max:100',
        'feedback' => 'nullable|string',
    ]);

    Evaluation::updateOrCreate(
        [
            'activity_id' => $request->activity_id,
            'child_id' => $request->child_id,
        ],
        [
            'grade' => $request->grade,
            'feedback' => $request->feedback,
        ]
    );

    return redirect()->route('evaluations.create-form', $request->activity_id)
                     ->with('success', 'Évaluation ajoutée avec succès.');
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
    public function edit(Evaluation $evaluation)
    {
        return view('evaluations.edit', compact('evaluation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvaluationRequest $request, string $id)
    {
        // Récupération des valeurs validées
        $validatedData = $request->validated();

        // Trouver l'évaluation par ID
        $evaluation = Evaluation::find($id);

        // Vérifier si l'évaluation existe
        if (!$evaluation) {
            return redirect()->route('evaluations.index')->with('error', 'Évaluation non trouvée.');
        }

        // Mettre à jour l'évaluation
        $evaluation->grade = $validatedData['grade'];
        $evaluation->feedback = $validatedData['feedback'] ?? $evaluation->feedback;
        $evaluation->save();

        // Rediriger vers la page d'affichage de l'évaluation
        return redirect()->route('evaluations.index', $evaluation->activity->id)
                            ->with('success', 'Évaluation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Trouver l'évaluation par ID
         $evaluation = Evaluation::find($id);

         // Vérifier si l'évaluation existe
         if (!$evaluation) {
             return redirect()->route('evaluations.index', $evaluation->activity->id)
                            ->with('error', 'Évaluation non trouvée.');
         }

 
         // Supprimer l'évaluation
         $evaluation->delete();
 
         // Rediriger avec un message de succès
         return redirect()->route('evaluations.index',$evaluation->activity_id)
                        ->with('success', 'Évaluation supprimée avec succès.');
    }

    public function showEvaluationsForConnectedTutor()
    {   
        if (!Gate::allows('view', Evaluation::class)) {
            // retourner une erreur 403 (accès interdit)
            abort(403, 'Accès non autorisé.');
        }

        // Obtenir le tuteur connecté
        $tutor = Auth::user(); // Assurez-vous que l'utilisateur connecté est un tuteur

        // Récupérer les évaluations pour les enfants du tuteur connecté
        $evaluations = Evaluation::getEvaluationsForTutor($tutor->tutor->id);

        // Préparer les données pour la vue
        $formattedEvaluations = [];

        foreach ($evaluations as $activityId => $evals) {
            foreach ($evals as $evaluation) {
                $child = $evaluation->child;
                $activity = $evaluation->activity;

                $formattedEvaluations[$child->id]['name'] = $child->lastname . ' ' . $child->firstname;
                $formattedEvaluations[$child->id]['evaluations'][] = [
                    'activity' => $activity->title,
                    'type' => $activity->activityType->name,
                    'category' => $activity->activityType->category,
                    'grade' => $evaluation->grade,
                    'feedback' => $evaluation->feedback,
                ];
            }
        }

        // Passer les données à la vue
        return view('evaluations.tutor', compact('formattedEvaluations', 'tutor'));
    }
}
