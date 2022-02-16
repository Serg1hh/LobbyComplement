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
use serg1h\lobbycomplement\LobbyComplement;

class DiscordCommand extends Command {

    public function __construct() {
        parent::__construct("discord", "Shows you the server discord!", null, ["dc"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
       $config = LobbyComplement::getInstance()->getConfig();

        if (!$sender instanceof Player) {
            return;
        }

        $sender->sendMessage("---------------------------------------");
        $sender->sendMessage(TextFormat::BLUE . $config->get('discord'));
        $sender->sendMessage("---------------------------------------");
    }

}