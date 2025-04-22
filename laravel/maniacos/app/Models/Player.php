<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'isSuspended' => 'boolean',
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'height' => 'nullable|integer',
        'weight' => 'nullable|integer',
        'birthdate' => 'required|date',
        'category' => 'required|string|max:255',
        'email' => 'required|email|unique:players,email',
        'isSuspended' => 'boolean',
    ];

    public function getAgeAttribute(): int
    {
        return $this->birthdate->age;
    }
}
