<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement\commands;


use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\command\CommandSender;
use pocketmine\item\ItemUseResult;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;

class SettingsCommand extends \pocketmine\command\Command {

    public function __construct() {
        parent::__construct("settings", "Open the player settings!", null, ["options"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
            $menu = InvMenu::create(InvMenuTypeIds::TYPE_HOPPER);
            $menu->setName("§5Settings");
            $menu->getInventory()->setContents([
                2 => VanillaItems::FEATHER()->setCustomName("§r§6Fly")->setLore(["Enable / disable the flight"]),
            ]);

            $menu->setListener(function(InvMenuTransaction $transaction): InvMenuTransactionResult {
                $player = $transaction->getPlayer();

                if($transaction->getItemClicked()->getCustomName() === "§r§6Fly") {
                    if(!$player->getAllowFlight()) {
                        $player->setFlying(true);
                        $player->setAllowFlight(true);
                    }
                    else {
                        $player->setFlying(false);
                        $player->setAllowFlight(false);
                    }
                }
                return $transaction->discard();
            });
            if ($sender instanceof Player) {
                $menu->send($sender);
            }
        return ItemUseResult::SUCCESS();
    }

}