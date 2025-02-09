<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use app\Actions\StorePlayer;

final class PlayerController extends Controller
{
    private $storePlayer;

    public function __construct(StorePlayer $storePlayer)
    {
        $this->storePlayer = $storePlayer;
    }

    public function cadastrar()
    {
        try {
            return view('player.create');
        } catch (\Exception $exception) {
            // TODO
        }
    }
}
