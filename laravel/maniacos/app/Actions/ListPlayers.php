<?php

declare(strict_types=1);

namespace app\Actions;

use App\Models\Player;

class ListPlayers
{
    public function handle(): ?array
    {
        return Player::all()->toArray();
    }
}
