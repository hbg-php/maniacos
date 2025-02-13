<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use app\Actions\ListPlayers;
use app\Actions\StorePlayer;

final class PlayerController extends Controller
{
    private readonly ListPlayers $listPlayersAction;

    private readonly StorePlayer $storePlayerAction;

    public function __construct(ListPlayers $listPlayersAction, StorePlayer $storePlayerAction)
    {
        $this->listPlayersAction = $listPlayersAction;
        $this->storePlayerAction = $storePlayerAction;
    }

    public function players()
    {
        try {
            $players = $this->listPlayersAction->handle();

            return view('player.list', compact($players));
        } catch (\Exception $exception) {
            dd($exception);
        }
    }

    public function create()
    {
        try {
            return view('player.create');
        } catch (\Exception $exception) {
            // TODO
        }
    }
}
