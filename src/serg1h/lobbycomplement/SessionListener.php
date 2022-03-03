<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement;


use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use serg1h\lobbycomplement\session\SessionFactory;

class SessionListener implements \pocketmine\event\Listener {

    public function onLogin(PlayerLoginEvent $event): void {
        SessionFactory::createSession($event->getPlayer());
    }

    public function onQuit(PlayerQuitEvent $event): void {
        SessionFactory::removeSession($event->getPlayer());
    }

}