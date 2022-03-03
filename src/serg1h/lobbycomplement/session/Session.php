<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement\session;


use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use serg1h\lobbycomplement\LobbyComplement;

class Session {


    public function __construct(
        private Player $player,
        private SessionScoreboard $scoreboard
    ) {}

    public function initScoreboard(): void {
        $this->scoreboard->init();
    }

    public function update(): void {
        $config = LobbyComplement::getInstance()->getConfig();

        $this->scoreboard->clear();
        foreach ($config->get('scoreboard-lines') as $content) {
            $content = str_replace(['{players_count}', '{player_ping}', '{player_nick}'], [count(Server::getInstance()->getOnlinePlayers()), $this->player->getNetworkSession()->getPing(), $this->player->getName()], $content);
            $this->scoreboard->addLine(TextFormat::colorize($content));
        }
    }

}