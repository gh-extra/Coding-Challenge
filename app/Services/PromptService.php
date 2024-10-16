<?php

namespace App\Services;

use App\Models\Chain;
use App\Models\Prompt;

class PromptService
{
    public function runSinglePrompt(Prompt $prompt): void
    {
        $previous_prompt_output = $this->getPreviousPromptOutput($prompt);

        $output = $prompt->chain->chat_engine->prompt($prompt->input . $previous_prompt_output);

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
