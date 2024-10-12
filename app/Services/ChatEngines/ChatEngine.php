<?php

namespace App\Services\ChatEngines;

interface ChatEngine
{
    const CHAT_ENGINE_GPT_3_5_TURBO = 'gpt-3.5-turbo';
    const CHAT_ENGINE_GPT_4_MINI = 'gpt-4-mini';

    const CHAT_ENGINES = [
        self::CHAT_ENGINE_GPT_3_5_TURBO,
        self::CHAT_ENGINE_GPT_4_MINI,
    ];

    public function prompt(string $input): string;
}
