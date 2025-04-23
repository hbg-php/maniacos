<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'height',
        'weight',
        'birthdate',
        'category',
        'email',
        'isSuspended',
    ];

    protected $casts = [
        'height' => 'integer',
        'weight' => 'integer',
        'birthdate' => 'date',
        'category' => 'integer',
        'isSuspended' => 'boolean',
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'height' => 'nullable|integer',
        'weight' => 'nullable|integer',
        'birthdate' => 'required|date',
        'category' => 'required',
        'email' => 'required|email|unique:players,email',
        'isSuspended' => 'boolean',
    ];

    public function getAgeAttribute(): int
    {
        return $this->birthdate->age;
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Position::class, 'player_position');
    }

}
