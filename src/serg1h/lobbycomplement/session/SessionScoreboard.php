<?php
/*
* Copyright (C) Serg1h - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace serg1h\lobbycomplement\session;


use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use pocketmine\player\Player;

class SessionScoreboard {

    private string $title;
    private array $lines;
    private bool $spawned;
    private Player $player;

    public function __construct(Player $player, string $title)  {
        $this->title = $title;
        $this->lines = [];
        $this->spawned = false;
        $this->player = $player;
    }

    public static function create(Player $player, string $title): self {
        return new self($player, $title);
    }

    public function isSpawned(): bool {
        return $this->spawned;
    }

    public function init(): void {
        if ($this->spawned) {
            return;
        }
        $pk = SetDisplayObjectivePacket::create(
            SetDisplayObjectivePacket::DISPLAY_SLOT_SIDEBAR,
            $this->player->getName(),
            $this->title,
            'dummy',
            SetDisplayObjectivePacket::SORT_ORDER_ASCENDING
        );
        $this->getPlayer()->getNetworkSession()->sendDataPacket($pk);
        $this->spawned = true;
    }

    public function getPlayer(): Player {
        return $this->player;
    }

    public function remove(): void {
        if (!$this->spawned) {
            return;
        }
        $pk = RemoveObjectivePacket::create(
            $this->player->getName()
        );
        $this->getPlayer()->getNetworkSession()->sendDataPacket($pk);
        $this->spawned = false;
    }

    public function addLine(string $line, ?int $id = null): void  {
        $id = $id ?? count($this->lines);

        $entry = new ScorePacketEntry();
        $entry->type = ScorePacketEntry::TYPE_FAKE_PLAYER;

        if (isset($this->lines[$id])) {
            $pk = new SetScorePacket();
            $pk->entries[] = $this->lines[$id];
            $pk->type = SetScorePacket::TYPE_REMOVE;
            $this->getPlayer()->getNetworkSession()->sendDataPacket($pk);
            unset($this->lines[$id]);
        }
        $entry->scoreboardId = $id;
        $entry->objectiveName = $this->getPlayer()->getName();
        $entry->score = $id;
        $entry->actorUniqueId = $this->getPlayer()->getId();
        $entry->customName = $line;
        $this->lines[$id] = $entry;

        $pk = new SetScorePacket();
        $pk->entries[] = $entry;
        $pk->type = SetScorePacket::TYPE_CHANGE;
        $this->getPlayer()->getNetworkSession()->sendDataPacket($pk);
    }

    public function removeLine(int $id): void  {
        if (isset($this->lines[$id])) {
            $line = $this->lines[$id];
            $pk = new SetScorePacket();
            $pk->entries[] = $line;
            $pk->type = SetScorePacket::TYPE_REMOVE;
            $this->getPlayer()->getNetworkSession()->sendDataPacket($pk);
            unset($this->lines[$id]);
        }
    }

    public function clear(): void  {
        $pk = new SetScorePacket();
        $pk->entries = $this->lines;
        $pk->type = SetScorePacket::TYPE_REMOVE;
        $this->getPlayer()->getNetworkSession()->sendDataPacket($pk);
        $this->lines = [];
    }

}