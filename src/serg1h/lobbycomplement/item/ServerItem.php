<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement\item;


use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemUseResult;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class ServerItem extends GodlyItem {

    public function __construct() {
        parent::__construct(new ItemIdentifier(ItemIds::NETHER_STAR, 0), "§r§6Server Selector");
    }

    public function onClickAir(Player $player, Vector3 $directionVector): ItemUseResult {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_HOPPER);
        $menu->setName("§r§6Servers");
        $menu->getInventory()->setContents([
            2 => VanillaItems::BOW()->setCustomName("§r§4TestServer")->setLore(["Plugin"]),
        ]);

        $menu->setListener(function (InvMenuTransaction $transaction): InvMenuTransactionResult {
            $player = $transaction->getPlayer();

            if($transaction->getItemClicked()->getCustomName() === "§r§4TestServer"){
                # modify your server ip (default port, you can mofidy the code to add your port)
                $player->transfer("plugin.test");
            }
            return $transaction->discard();
        });
        $menu->send($player);
        return ItemUseResult::SUCCESS();
    }

}