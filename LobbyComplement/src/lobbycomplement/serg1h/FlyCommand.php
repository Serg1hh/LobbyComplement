<?php

declare(strict_types=1);

namespace lobbycomplement\serg1h;


use pocketmine\command\Command;
use pocketmine\Player\player;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class FlyCommand extends Command {

    public function __construct(LobbyComplement $plugin) {

        parent::__construct("fly", 'Allows you to flight!.');
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {


        $player = $sender->getServer()->getPlayerByPrefix();

        if ($player instanceof Player) {

            if ($player->getAllowFlight() === false) {
                $player->setFlying(true);
                $player->setAllowFlight(true);
                $player->sendMessage(TextFormat::DARK_GREEN . "You have enabled the flight!");
            } else {
                $player->setFLying(false);
                $player->setAllowFlight(false);
                $player->sendMessage(TextFormat::BLUE . "You have disabled the flight!");
            }
        }
    }
}

