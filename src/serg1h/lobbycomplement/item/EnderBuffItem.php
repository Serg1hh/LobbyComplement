<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement\item;


use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\sound\EndermanTeleportSound;

class EnderBuffItem extends GodlyItem {

    public function __construct() {
        parent::__construct(new ItemIdentifier(ItemIds::ENDER_PEARL, 1), "§r§6EnderBuff");
    }

    public function onClickAir(Player $player, Vector3 $directionVector): ItemUseResult {
        $world = $player->getWorld();
        $player->setMotion($player->getDirectionVector()->multiply(1.8));
        $world->addSound($player->getPosition(), new EndermanTeleportSound(), [$player]);
        return ItemUseResult::FAIL();
    }

}