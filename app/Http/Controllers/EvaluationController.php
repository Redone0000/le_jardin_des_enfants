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


class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($activityId)
    {
        // Récupérer l'activité en question
        $activity = Activity::with('activityType')->findOrFail($activityId);

        // Récupérer les évaluations pour cette activité spécifique
        $evaluations = Evaluation::where('activity_id', $activityId)->with('child')->get();
        // dd($activity, $evaluations);

        return view('evaluations.index', compact('activity', 'evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {      
        $activity = Activity::findOrFail($id);
        
        $children = $activity->class->children;

        return view('evaluations.create', compact('activity', 'children'));
    }
    

    public function store(StoreEvaluationRequest $request)
    {
                // Récupération des valeurs validées
                $activityId = $request->activity_id;
                $grades = $request->grades;
                $feedback = $request->feedback;
                $childIds = $request->child_ids;
        
                // Boucle pour créer les évaluations
                foreach ($childIds as $childId) {
                    // Assurez-vous que les évaluations ne sont pas dupliquées
                    Evaluation::updateOrCreate(
                        [
                            'activity_id' => $activityId,
                            'child_id' => $childId
                        ],
                        [
                            'grade' => $grades[$childId] ?? null,
                            'feedback' => $feedback[$childId] ?? null,
                        ]
                    );
                }
        
                // Redirection ou retour avec un message de succès
                return redirect()->route('activity.index')->with('success', 'Évaluations enregistrées avec succès !');
        
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
}
