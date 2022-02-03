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
use pocketmine\utils\TextFormat;

class FlyCommand extends Command {

    public function __construct() {
        parent::__construct("fly", 'Allows you to flight!.', null, ["f", "flight"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!$sender instanceof Player) {
            return;
        }

        if (!$sender->getAllowFlight()) {
            $sender->setFlying(true);
            $sender->setAllowFlight(true);
            $sender->sendMessage(TextFormat::DARK_GREEN . "You have enabled the flight!");

        } else {
            $sender->setFLying(false);
            $sender->setAllowFlight(false);
            $sender->sendMessage(TextFormat::BLUE . "You have disabled the flight!");
        }
    }

}
