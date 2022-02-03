<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement\commands;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class SpawnCommand extends Command {

    public function __construct() {
        parent::__construct("spawn", 'Teleport you to the server spawn!', null, ["hub", "lobby"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if ($sender instanceof Player) {
            $sender->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
        }
    }

}
