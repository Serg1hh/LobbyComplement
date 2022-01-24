<?php

namespace lobbycomplement\serg1h;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class LobbyComplement extends PluginBase implements Listener {

    public function onEnable() {

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->getServer()->getCommandMap()->register("fly", new FlyCommand($this));
    }

    public function onExhaust(PlayerExhaustEvent $event): void {
            $event->setCancelled();  // default is true
        }

    public function onDamage(EntityDamageEvent $event) {
        if ($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
            $event->setCancelled(); // default is true
        }
    }
}
