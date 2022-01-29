<?php

namespace serg1h\lobbycomplement;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;

class Events implements Listener {

    public function onExhaust(PlayerExhaustEvent $event): void {

        $event->cancel();
    }

    public function onDamage(EntityDamageEvent $event) {

        if ($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
            $event->cancel();
        }
        if ($event->getCause() === EntityDamageEvent::CAUSE_DROWNING) {
            $event->cancel();
        }
        if ($event->getCause() === EntityDamageEvent::CAUSE_SUFFOCATION) {
            $event->cancel();
        }
        if ($event->getCause() === EntityDamageEvent::CAUSE_FIRE) {
            $event->cancel();
        }
        if ($event->getCause() === EntityDamageEvent::CAUSE_ENTITY_ATTACK) {
            $event->cancel();
        }
        if ($event->getCause() === EntityDamageEvent::CAUSE_LAVA) {
            $event->cancel();
        }
        if ($event->getCause() === EntityDamageEvent::CAUSE_FIRE_TICK) {
            $event->cancel();
        }
    }
}
