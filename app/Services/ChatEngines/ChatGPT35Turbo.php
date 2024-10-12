<?php

namespace App\Services\ChatEngines;

use OpenAI\Laravel\Facades\OpenAI;

class ChatGPT35Turbo implements ChatEngine
{
    public function prompt(string $input): string
    {
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $input],
            ],
        ]);

        return $result->choices[0]->message->content;
    }
}
