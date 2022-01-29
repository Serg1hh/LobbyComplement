<?php

namespace serg1h\lobbycomplement;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\plugin\PluginBase;

class LobbyComplement extends PluginBase implements Listener {

    protected function onEnable(): void {

        $this->registerListener(new Events());
        $this->getServer()->getCommandMap()->register("fly", new FlyCommand($this));

        $this->getServer()->getLogger()->info("LobbyComplement has been enabled");
    }

    private function registerListener(Listener $listener): void {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }
}
