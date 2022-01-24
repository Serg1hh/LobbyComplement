<?php

declare(strict_types=1);

namespace lobbycomplement\serg1h;


use pocketmine\Player;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use lobbycomplement\serg1h\LobbyComplement;
use pocketmine\utils\TextFormat;

class FlyCommand extends PluginCommand {

    public function __construct(LobbyComplement $plugin) {

        parent::__construct("fly", $plugin);
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {


        $player = $sender->getPlayer();

        if ($player instanceof Player) {

            if ($player->getAllowFlight() === false) {
                $player->setFlying(true);
                $player->setAllowFlight(true);
                $player->sendMessage(TextFormat::DARK_GREEN . "Flight has been enabled!");
            } else {
                $player->setFLying(false);
                $player->setAllowFlight(false);
                $player->sendMessage(TextFormat::BLUE . "Flight has been disabled");
            }
        }
    }
}