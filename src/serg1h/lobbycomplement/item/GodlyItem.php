<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement\item;


use pocketmine\item\ItemIdentifier;

class GodlyItem extends \pocketmine\item\Item {

    public function __construct(ItemIdentifier $identifier, string $name) {
        $this->setCustomName($name);
        parent::__construct($identifier, $name);
        $this->getNamedTag()->setByte("lobby", 1);
    }

}