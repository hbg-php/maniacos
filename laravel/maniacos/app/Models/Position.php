<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'player_position');
    }

}
