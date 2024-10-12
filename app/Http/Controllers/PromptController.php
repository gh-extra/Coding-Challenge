<?php

namespace App\Http\Controllers;

use App\Models\Chain;
use App\Models\Prompt;
use App\Services\PromptService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PromptController extends Controller
{
    public function __construct(private PromptService $prompt_service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Chain $chain)
    {
        $request->validate([
            'input' => 'required|string',
        ]);

        Prompt::create([
            'input' => $request->input('input'),
            'chain_id' => $chain->id,
        ]);

        return redirect()->route('chains.show', $chain->id)->with('success', 'Prompt created successfully');
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
    public function update(Request $request, Chain $chain, Prompt $prompt)
    {
        $request->validate([
            'input' => 'required|string',
        ]);

        // TODO: validate this prompt belongs to the user
        $prompt->update(['input' => $request->input('input')]);

        return Redirect::route('chains.show', ['chain' => $prompt->chain_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chain $chain, Prompt $prompt)
    {
        // TODO: validate this prompt belongs to the user
        $prompt->delete();

        return Redirect::route('chains.show', ['chain' => $prompt->chain_id]);
    }

    public function run(Request $request, Chain $chain, Prompt $prompt)
    {
        // 1st we update the Prompt with the latest input typed by the user
        $request->validate([
            'input' => 'required|string',
        ]);

        // TODO: validate this prompt belongs to the user
        $prompt->update(['input' => $request->input('input')]);

        $this->prompt_service->runSinglePrompt($prompt);

        return Inertia::location(route('chains.show', $chain->id));
    }
}
