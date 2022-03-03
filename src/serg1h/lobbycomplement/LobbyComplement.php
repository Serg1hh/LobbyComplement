<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement;

use muqsit\invmenu\InvMenuHandler;
use pocketmine\event\Listener;
use pocketmine\permission\DefaultPermissions;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use serg1h\lobbycomplement\commands\DiscordCommand;
use serg1h\lobbycomplement\commands\FlyCommand;
use serg1h\lobbycomplement\commands\SettingsCommand;
use serg1h\lobbycomplement\commands\SpawnCommand;
use pocketmine\utils\SingletonTrait;
use serg1h\lobbycomplement\session\SessionFactory;

class LobbyComplement extends PluginBase {
    use SingletonTrait;

    protected function onLoad(): void {
        self::setInstance($this);
    }

    protected function onEnable(): void {
        $server = $this->getServer();
        $this->saveResource("config.yml");

        $this->registerPermission("break.block");
        $this->registerPermission("place.block");

        $server->getCommandMap()->register("fly", new FlyCommand());
        $server->getCommandMap()->register("spawn", new SpawnCommand());
        $server->getCommandMap()->register("discord", new DiscordCommand());
        $server->getCommandMap()->register("settings", new SettingsCommand());
        $this->registerListener(new LobbyListener());
        $this->registerListener(new SessionListener());
        $this->registerListener(new ItemListener());

        if(!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
        }
        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask (function (): void {
            $this->getServer()->broadcastMessage(" \n§r§l§6Discord\n\n§r§7¡Asegurate de entrar a nuestro servidor de\nDiscord para enterarte de noticias y eventos!§6§o\n\n" . $this->getConfig()->get("discord") . " \n");
        }), 45 * 20);

        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask (function (): void {
            foreach (SessionFactory::getSessions() as $session)
                $session->update();
        }), 10);
    }

    private function registerListener(Listener $listener): void {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }

    private function registerPermission(string $permission): void {
        $manager = PermissionManager::getInstance();
        $manager->addPermission(new Permission($permission));
        $manager->getPermission(DefaultPermissions::ROOT_OPERATOR)->addChild($permission, true);
    }

}



