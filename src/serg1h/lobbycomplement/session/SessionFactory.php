<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement\session;


use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use serg1h\lobbycomplement\LobbyComplement;

class SessionFactory {

    static private array $sessions = [];


    public static function getSessions(): array {
        return self::$sessions;
    }

    public static function getSession(Player $player): ?Session  {
        return self::$sessions[$player->getName()] ?? null;
    }

    public static function createSession(Player $player): void  {
        self::$sessions[$player->getName()] = new Session(
            $player,
            SessionScoreboard::create($player, TextFormat::colorize(LobbyComplement::getInstance()->getConfig()->get('scoreboard-title')))
        );
    }

    public static function removeSession(Player $player): void {
        unset(self::$sessions[$player->getName()]);
    }

}