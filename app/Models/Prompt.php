<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'chain_id',
        'input',
        'output',
        'last_run_at',
        'position',
    ];

    protected $visible = [
        'id',
        'chain_id',
        'input',
        'output',
        'last_run_at',
        'position',
    ];

    public function chain(): BelongsTo
    {
        return $this->belongsTo(Chain::class);
    }
}
