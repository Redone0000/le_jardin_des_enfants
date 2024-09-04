<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuDay;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();

        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentYear = date('Y');
        $years = collect(range(date('Y') - 5, date('Y') + 5));
        $months = collect(range(1, 12))->map(function ($month) {
            return \Carbon\Carbon::create()->month($month);
        });
    
        return view('menus.create', [
            'years' => $years,
            'months' => $months,
            'currentYear' => $currentYear,
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
            'price' => 'required|numeric|min:0',
            'dates.*' => 'required|date',
            'meals.*' => 'required|string',
        ]);
    
        // Créer le menu
        $menu = Menu::create([
            'month' => $request->input('month'),
            'price' => $request->input('price'),
        ]);
    
        // Enregistrer les jours du menu
        $dates = $request->input('dates');
        $meals = $request->input('meals');
    
        foreach ($dates as $index => $date) {
            MenuDay::create([
                'menu_id' => $menu->id,
                'date' => $date,
                'meal' => $meals[$index],
            ]);
        }
    
        return redirect()->route('menus.index')->with('success', 'Menu créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        $menuDays = $menu->menuDays; // Assurez-vous que la relation est définie dans le modèle Menu
    
        return view('menus.show', compact('menu', 'menuDays'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = Menu::with('menuDays')->findOrFail($id); // Charger les jours associés
        $years = range(date('Y') - 10, date('Y') + 10); // Plage d'années
        $months = collect(range(1, 12))->map(fn($month) => \Carbon\Carbon::create()->month($month));

        $menuDays = $menu->menuDays->pluck('meal', 'date')->toArray();


        return view('menus.edit', [
            'menu' => $menu,
            'years' => $years,
            'months' => $months,
            'menuDays' => $menuDays
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'month' => 'required|string',
        'price' => 'required|numeric|min:0',
        'dates.*' => 'required|date',
        'meals.*' => 'required|string',
    ]);

    // Trouver le menu à mettre à jour
    $menu = Menu::findOrFail($id);

    // Mettre à jour le menu
    $menu->update([
        'month' => $request->input('month'),
        'price' => $request->input('price'),
    ]);

    // Supprimer les anciens jours du menu
    $menu->menuDays()->delete();

    // Enregistrer les jours du menu
    $dates = $request->input('dates');
    $meals = $request->input('meals');

    foreach ($dates as $index => $date) {
        MenuDay::create([
            'menu_id' => $menu->id,
            'date' => $date,
            'meal' => $meals[$index],
        ]);
    }

    return redirect()->route('menus.index')->with('success', 'Menu mis à jour avec succès.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu supprimé avec succès.');
    }

//     public function showNextMonthsMenus()
// {
//     $startDate = Carbon::now()->startOfMonth()->addMonth(); // Début du mois prochain
//     $endDate = Carbon::now()->addMonths(3)->endOfMonth(); // Fin du troisième mois à venir

//     $menuDays = MenuDay::whereBetween('date', [$startDate, $endDate])
//                        ->orderBy('date')
//                        ->get();

//     return view('menus.next_menus', compact('menuDays', 'startDate', 'endDate'));
// }

public function showNextMonthsMenus()
{
    $startDate = Carbon::now()->startOfMonth();
    $endDate = Carbon::now()->addMonths(2)->endOfMonth();
    
    // Obtenir les jours de menu pour les trois mois prochains
    $menuDays = MenuDay::whereBetween('date', [$startDate, $endDate])
                       ->orderBy('date')
                       ->get();

    return view('menus.next_menus', compact('menuDays'));
}
}
