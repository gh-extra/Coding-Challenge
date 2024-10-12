<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PromptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Prompt $prompt)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prompt $prompt)
    {
        // TODO: validate this prompt belongs to the user
        $prompt->update(['input' => $request->input('input')]);

        return Redirect::route('chain.show', ['chain' => $prompt->chain_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prompt $prompt)
    {
        // TODO: validate this prompt belongs to the user
        $prompt->delete();

        // TODO: prompts after this one need to be re-ordered

        return Redirect::route('chain.show', ['chain' => $prompt->chain_id]);
    }
}
