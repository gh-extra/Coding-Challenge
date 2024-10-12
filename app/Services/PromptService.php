<?php

namespace App\Services;

use App\Models\Chain;
use App\Models\Prompt;
use App\Services\ChatEngines\ChatEngine;

class PromptService
{
    // TODO: fix dependency injection, and automatically resolve ChatEngine based off the current session's Chain
    // public function __construct(private ChatEngine $chat_engine)
    // {
    // }

    public function runSinglePrompt(Prompt $prompt): void
    {
        /** @var ChatEngine $chat_engine */
        $chat_engine = app($prompt->chain->chat_engine_id);

        $previous_prompt_output = $this->getPreviousPromptOutput($prompt);

        $output = $chat_engine->prompt($prompt->input . $previous_prompt_output);

        $prompt->output = $output;
        $prompt->save();
    }

    public function runChain(Chain $chain): void
    {
        $chain->prompts->each(fn (Prompt $prompt) => $this->runSinglePrompt($prompt));
    }

    public function getPreviousPromptOutput(Prompt $prompt): string
    {
        /** @var Prompt $previous_prompt */
        $previous_prompt = $prompt->chain
            ->prompts()
            ->where('id', '<', $prompt->id)
            ->latest()
            ->first();

        return $previous_prompt->output ?? '';
    }
}
