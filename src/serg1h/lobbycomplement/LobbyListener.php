<?php

namespace serg1h\lobbycomplement;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class LobbyListener implements Listener {

    public function onJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $player->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());

        $event->setJoinMessage(TextFormat::colorize("&2[&r&+&2]" . $player->getName()));
        $player->sendMessage("-----------------------------------------------");
        $player->sendMessage("Welcome to " . TextFormat::DARK_PURPLE . "server");
        $player->sendMessage("Discord: " . TextFormat::BLUE . "discord.gg/YourServer");
        $player->sendMessage("-----------------------------------------------");
    }

    public function onExhaust(PlayerExhaustEvent $event): void {
        $event->cancel();
    }

    public function onDamage(EntityDamageEvent $event): void {
        $entity = $event->getEntity();
        if($entity instanceof Player and $event->getCause() === EntityDamageEvent::CAUSE_VOID) {
            $entity->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
        }
        $event->cancel();
    }

    public function onPlace(BlockPlaceEvent $event): void {
        if (!$event->getPlayer()->hasPermission("place.block")) {
            $event->cancel();;
        }
    }

    public function onBreak(BlockBreakEvent $event): void {
        if (!$event->getPlayer()->hasPermission("break.block")) {
            $event->cancel();;
        }
    }

    public function onQuit(PlayerQuitEvent $event) {
        $event->setQuitMessage(TextFormat::colorize("&4[&r-&4]" . $event->getPlayer()->getName()));
    }

}
