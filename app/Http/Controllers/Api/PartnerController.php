<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Requests\StorePartnerRequest;


class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PartnerResource::collection(Partner::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        $validatedData = $request->validated();

        $partner = Partner::create($validatedData);

        return new PartnerResource($partner);
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $id)
    {
        return new PartnerResource($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $id->update($validatedData);
        return new PartnerResource($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $id)
    {   
        $id->delete();
        return response()->json(null, 204);
    }
}
