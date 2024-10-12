<?php

namespace App\Models;

use App\Services\ChatEngines\ChatEngine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chain extends Model
{
    use HasFactory;

    private ?ChatEngine $chat_engine = null;

    protected $fillable = [
        'name',
        'description',
        'chat_engine_id',
        'user_id',
        'last_run_at',
    ];

    protected $visible = [
        'id',
        'name',
        'chat_engine_id',
        'description',
        'user_id',
        'last_run_at',
        'prompts',
    ];

    public function prompts(): HasMany
    {
        return $this->hasMany(Prompt::class);
    }

    public function getChatEngineAttribute(): ChatEngine
    {
        if (!$this->chat_engine) {
            $this->chat_engine = app($this->chat_engine_id);
        }

        return $this->chat_engine;
    }
}
