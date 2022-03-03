<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement;


use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\Server;

class ItemListener implements \pocketmine\event\Listener {

    public function slot_change(InventoryTransactionEvent $event): void {
        $player = $event->getTransaction()->getSource();

        foreach ($event->getTransaction()->getActions() as $action) {
            if (($action instanceof SlotChangeAction) && !Server::getInstance()->isOp($player->getName())) {
                $event->cancel();
            }
        }
    }

}