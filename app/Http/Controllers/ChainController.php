<?php

namespace App\Http\Controllers;

use App\Models\Chain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ChainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Chain/List', [
            'chains' => Chain::where('user_id', $request->user()->id)->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Chain/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Chain::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('chain.index')->with('success', 'Chain created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chain $chain)
    {
        // TODO: validate this chain belongs to the user
        return Inertia::render('Chain/Show', [
            'chain' => $chain->load([
                'prompts' => fn ($query) => $query->orderBy('position'),
            ])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chain $chain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chain $chain)
    {
        // TODO: validate this chain belongs to the user
        $chain->delete();

        return Redirect::route('chain.index');
    }
}
