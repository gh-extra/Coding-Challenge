<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chain extends Model
{
    use HasFactory;

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
}
