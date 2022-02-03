<?php

namespace serg1h\lobbycomplement;

use pocketmine\block\Water;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class LobbyListener implements Listener {


    public function onJoin(PlayerJoinEvent $event): void {
        $config = LobbyComplement::getInstance()->getConfig();
        $player = $event->getPlayer();
        $player->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());

        $event->setJoinMessage(TextFormat::colorize("&2[&r+&2]&r " . $player->getName()));
        $player->sendMessage("-----------------------------------------------");
        $player->sendMessage("Welcome to " . TextFormat::DARK_PURPLE . $config->get('server-name'));
        $player->sendMessage("Discord: " . TextFormat::BLUE . $config->get('discord'));
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
        $event->setQuitMessage(TextFormat::colorize("&4[&r-&4]&r " . $event->getPlayer()->getName()));
    }

    public function onInteract(PlayerInteractEvent $event) {
        if (!$event->getPlayer()->hasPermission("place.block")) {
            $event->cancel();
        }
    }

}
