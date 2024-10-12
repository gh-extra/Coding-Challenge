<?php

namespace App\Providers;

use App\Services\ChatEngines\ChatEngine;
use App\Services\ChatEngines\ChatGPT35Turbo;
use App\Services\ChatEngines\ChatGPT4Mini;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ChatEngine::CHAT_ENGINE_GPT_3_5_TURBO, ChatGPT35Turbo::class);
        $this->app->bind(ChatEngine::CHAT_ENGINE_GPT_4_MINI, ChatGPT4Mini::class);
    }

    public function boot()
    {
        //
    }
}
