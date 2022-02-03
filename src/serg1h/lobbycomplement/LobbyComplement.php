<?php

namespace serg1h\lobbycomplement;

use pocketmine\event\Listener;
use pocketmine\permission\DefaultPermissions;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;
use pocketmine\plugin\PluginBase;
use serg1h\lobbycomplement\commands\FlyCommand;
use serg1h\lobbycomplement\commands\SpawnCommand;
use pocketmine\utils\SingletonTrait;

class LobbyComplement extends PluginBase {
    use SingletonTrait;

    protected function onLoad(): void {
        self::setInstance($this);
    }

    protected function onEnable(): void {
        $server = $this->getServer();

        $this->saveResource("config.yml");
        // Register permissions
        $this->registerPermission("break.block");
        $this->registerPermission("place.block");

        // Register command
        $server->getCommandMap()->register("fly", new FlyCommand());
        $server->getCommandMap()->register("fly", new SpawnCommand());
        // Register listener
        $this->registerListener(new LobbyListener());

        // Send a message to the logger
        $server->getLogger()->info("LobbyComplement has been enabled");
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



