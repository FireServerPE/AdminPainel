<?php
declare(strict_types=1);

namespace PocketmineSmash\AdminPainel\Gadgets;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use PocketmineSmash\AdminPainel\Main;
use pocketmine\Player;
use pocketmine\inventory\PlayerInventory;
use pocketmine\item\Item;
use pocketmine\event\player\PlayerKickEvent;

class Gadgets implements Listener {
    public function __construct(Main $main)
    {
        $this->main = $main;
    }


    public function onKick(EntityDamageByEntityEvent $event, Player $player, PlayerInteractEvent $e) {
        if ($event instanceof EntityDamageByEntityEvent) {
            $admin = $event->getDamager();
            $user = $event->getEntity();
            if($admin instanceof Player and $user instanceof Player) {
                if($admin->getInventory()->getItemInHand()->getId() == 280){
                    $user->getPlayer()->kick("Kicked FromServer");
                }
                }
            }
        }
}




