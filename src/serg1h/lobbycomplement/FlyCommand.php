<?php

namespace serg1h\lobbycomplement;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class FlyCommand extends Command {

    public function __construct(LobbyComplement $plugin) {

        parent::__construct("fly", 'Allows you to flight!.');
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if ($sender instanceof Player) {

            if ($sender->getAllowFlight() === false) {
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
}