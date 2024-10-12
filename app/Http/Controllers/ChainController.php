<?php

namespace App\Http\Controllers;

use App\Models\Chain;
use App\Services\ChatEngines\ChatEngine;
use App\Services\PromptService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ChainController extends Controller
{
    public function __construct(private PromptService $prompt_service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Chain/Index', [
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
            'chat_engine_id' => 'required|string|max:255|in:' . implode(',', ChatEngine::CHAT_ENGINES),
        ]);

        $chain = Chain::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'chat_engine_id' => $request->input('chat_engine_id'),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('chains.show', $chain->id)->with('success', 'Chain created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chain $chain)
    {
        return Inertia::render('Chain/Show', [
            'chain' => $chain->load([
                'prompts' => fn ($query) => $query->orderBy('id'),
            ])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chain $chain)
    {
        DB::transaction(function () use ($chain) {
            $chain->prompts()->delete();

            $chain->delete();
        });

        return Redirect::route('chains.index');
    }

    public function run(Request $request, Chain $chain)
    {
        $this->prompt_service->runChain($chain);

        return Inertia::location(route('chains.show', $chain->id));
    }
}
