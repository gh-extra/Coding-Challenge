<?php

use App\Models\Chain;
use App\Models\Prompt;
use App\Services\PromptService;
use App\Services\ChatEngines\ChatEngine;
use App\Services\ChatEngines\ChatGPT35Turbo;
use App\Services\ChatEngines\ChatGPT4Mini;

beforeEach(function () {
    $this->chat_engine_mock = Mockery::mock(ChatEngine::class);
    $this->chat_engine_mock->shouldReceive('prompt')
        ->andReturnUsing(function ($input) {
            return 'Output for: ' . $input;
        });

    app()->instance(ChatGPT35Turbo::class, $this->chat_engine_mock);
    app()->instance(ChatGPT4Mini::class, $this->chat_engine_mock);

    $this->prompt_service = app(PromptService::class);
});

it('can run a single prompt', function () {
    $chain = Chain::factory()->create();
    $prompt = Prompt::factory()->create([
        'chain_id' => $chain->id,
        'input' => 'Test input',
        'output' => null,
    ]);

    $this->prompt_service->runSinglePrompt($prompt);

    $prompt->refresh();
    expect($prompt->output)->toBe('Output for: Test input');
});

it('can run a prompt chain', function () {
    $chain = Chain::factory()->create();
    $prompts = Prompt::factory()->count(3)->sequence(
        ['chain_id' => $chain->id, 'input' => 'First prompt', 'output' => null],
        ['chain_id' => $chain->id, 'input' => 'Second prompt', 'output' => null],
        ['chain_id' => $chain->id, 'input' => 'Third prompt', 'output' => null]
    )->create();

    $this->prompt_service->runChain($chain);

    foreach ($prompts as $prompt) {
        $prompt->refresh();
        expect($prompt->output)->toContain('Output for: ' . $prompt->input);
    }
});

it('gets previous prompt output correctly', function () {
    $chain = Chain::factory()->create();
    $previous_prompt = Prompt::factory()->create([
        'chain_id' => $chain->id,
        'input' => 'Previous input',
        'output' => 'Previous output',
    ]);
    $current_prompt = Prompt::factory()->create([
        'chain_id' => $chain->id,
        'input' => 'Current input',
    ]);

    $previous_output = $this->prompt_service->getPreviousPromptOutput($current_prompt);

    expect($previous_output)->toBe('Previous output');
});

it('returns an empty string when no previous prompt exists', function () {
    $chain = Chain::factory()->create();
    $first_prompt = Prompt::factory()->create([
        'chain_id' => $chain->id,
        'input' => 'First input',
        'output' => 'First output',
    ]);

    $previous_output = $this->prompt_service->getPreviousPromptOutput($first_prompt);

    expect($previous_output)->toBe('');
});
