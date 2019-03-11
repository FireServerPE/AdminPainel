<?php

declare(strict_types=1);

/*
     _______/*
 * TO DO
 * - Kick player con razon - 280:0
 * - Ban player con razon - 369:0
 * - mute player - 450:0
 * - Change time - 347:0
 * - Change weather - 345:0
 * - Gamemode changer - 378:0
 * - Vanish - 388:0
 * - User info - 340:0
 * - Gametag - 318:0
 *
 * This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU Lesser General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMineSmash
* @link https://github.com/PocketmineSmash
 *
 *
*/

namespace PocketmineSmash\AdminPainel;


use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginDescription;
use pocketmine\plugin\PluginLoader;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TE;
use PocketmineSmash\AdminPainel\Gadgets\Gadgets;


class Main extends PluginBase implements Listener
{
    public $status = 0;

    /*
     * Plugin made by PocketmineSmash
     * Github: https://github.com/PocketmineSmash
     */

    public function __construct(PluginLoader $loader, Server $server, PluginDescription $description, string $dataFolder, string $file)
    {
        parent::__construct($loader, $server, $description, $dataFolder, $file);
    }

    public function onEnable()
    {
        $this->getLogger()->info(TE::AQUA . "AdminPainel Activado");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getServer()->getPluginManager()->registerEvents(new Gadgets($this),$this);
    }

    public function giveGadgets(Player $player) {
        $inv = $player->getInventory();
        $kick = Item::get(280, 0,1);
        $kick_n = $kick->setCustomName("Kick");
        $ban = Item::get(369,0,1);
        $ban_n = $ban->setCustomName("Ban");
        $mute = Item::get(450,0,1);
        $mute_n = $mute->setCustomName("Mute");
        $time = Item::get(347,0,1);
        $time_n = $time->setCustomName("Time");
        $weather = Item::get(345,0,1);
        $weather_n = $weather->setCustomName("Weather");
        $gamemode = Item::get(378,0,1);
        $gamemode_n = $gamemode->setCustomName("Gamemode");
        $vanish = Item::get(388, 0,1);
        $vanish_n = $vanish->setCustomName("Vanish");
        $user_info = Item::get(340,0,1);
        $user_info_n = $user_info->setCustomName("User info");
        $gametag = Item::get(318,0,1);
        $gametag_n = $gametag->setCustomName("Gametag");
        $inv->setContents(array($kick_n, $ban_n, $mute_n, $time_n, $weather_n, $gamemode_n, $vanish_n, $user_info_n, $gametag_n));
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $cmd = $command->getName();
        if(!$sender instanceof Player) {
            $sender->sendMessage("Usa este comando en juego");
        }
        elseif ($cmd === "painel") {
                if (!isset($args[0])) {
                    $sender->sendMessage("Admin Painel Help");
                }
                elseif ($args[0] === "enable") {
                    $this->status = 1;
                    $this->giveGadgets($sender);
                    $sender->sendMessage("Panel activado");
                }
                elseif ($args[0] === "disable") {
                    $this->status = 0;
                    $sender->sendMessage("Panel desactivado");
                }
        }
        return true;
    }
}

