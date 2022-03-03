<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use serg1h\lobbycomplement\item\EnderBuffItem;
use serg1h\lobbycomplement\item\ServerItem;
use serg1h\lobbycomplement\session\SessionFactory;

class LobbyListener implements Listener {


    public function onJoin(PlayerJoinEvent $event): void {
        $config = LobbyComplement::getInstance()->getConfig();
        $player = $event->getPlayer();
        $player->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
        $session = SessionFactory::getSession($player = $event->getPlayer());
        $session->initScoreboard();
        $player->getArmorInventory()->clearAll();
        $event->setJoinMessage(TextFormat::colorize("&2[&r+&2]&r " . $player->getName()));
        $player->sendMessage("-----------------------------------------------");
        $player->sendMessage("Welcome to " . TextFormat::DARK_PURPLE . $config->get('server-name'));
        $player->sendMessage("Discord: " . TextFormat::BLUE . $config->get('discord'));
        $player->sendMessage("-----------------------------------------------");
        $player->sendTitle(TextFormat::colorize($config->get("server-name")));
        $player->sendSubTitle("§r§fWelcome §r§7" . $player->getName());
        $player->setGamemode(GameMode::ADVENTURE());
        $player->getInventory()->setItem(0, new EnderBuffItem());
        $player->getInventory()->setItem(4, new ServerItem());
    }

    public function onExhaust(PlayerExhaustEvent $event): void {
        $event->cancel();
    }

    public function onDamage(EntityDamageEvent $event): void {
        $entity = $event->getEntity();
        if ($entity instanceof Player && $event->getCause() === EntityDamageEvent::CAUSE_VOID) {
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
        $config = LobbyComplement::getInstance()->getConfig();
        $event->setQuitMessage(TextFormat::colorize("&4[&r-&4]&r " . $event->getPlayer()->getName()));
    }

    public function onInteract(PlayerInteractEvent $event) {
        if (!$event->getPlayer()->hasPermission("place.block")) {
            $event->cancel();
        }
    }

}
