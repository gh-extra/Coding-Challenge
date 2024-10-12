<?php

namespace App\Services\ChatEngines;

use OpenAI\Laravel\Facades\OpenAI;

class ChatGPT4Mini implements ChatEngine
{
    public function prompt(string $input): string
    {
        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => $input],
            ],
        ]);

        return $result->choices[0]->message->content;
    }
}
