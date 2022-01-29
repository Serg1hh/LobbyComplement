<?php

namespace serg1h\lobbycomplement;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\plugin\PluginBase;

class LobbyComplement extends PluginBase implements Listener {

    protected function onEnable(): void {

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getCommandMap()->register("fly", new FlyCommand($this));

        $this->getServer()->getLogger()->info("LobbyComplement has been enabled");
    }

    public function onExhaust(PlayerExhaustEvent $event): void {

        $event->cancel();  // default is true
    }

    public function onDamage(EntityDamageEvent $event) {

        if ($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
            if ($event->getCause() === EntityDamageEvent::CAUSE_DROWNING) {
                if ($event->getCause() === EntityDamageEvent::CAUSE_SUFFOCATION) {
                    if ($event->getCause() === EntityDamageEvent::CAUSE_FIRE) {
                        if ($event->getCause() === EntityDamageEvent::CAUSE_ENTITY_ATTACK) {
                            $event->cancel(); // default is tru
                        }
                    }
                }
            }
        }
    }
}
