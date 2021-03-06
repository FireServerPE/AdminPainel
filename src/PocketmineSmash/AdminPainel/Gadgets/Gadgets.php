<?php
declare(strict_types=1);
namespace PocketmineSmash\AdminPainel\Gadgets;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use PocketmineSmash\AdminPainel\Main;
use pocketmine\Player;
use pocketmine\inventory\PlayerInventory;
use pocketmine\item\Item;
use pocketmine\event\player\PlayerKickEvent;
use pocketmine\level\Level;
use pocketmine\plugin\Plugin;

class Gadgets implements Listener {
    public function __construct(Main $pl)
    {
        $this->pl = $pl;
        $pl->getServer()->getPluginManager()->registerEvents($pl, $this);
    }
    public function onKick(EntityDamageEvent $event)
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $admin = $event->getDamager();
            $user = $event->getEntity();
            if ($admin instanceof Player and $user instanceof Player) {
                if ($admin->getInventory()->getItemInHand()->getId() == 280) {
                    $user->kick("Kicked from server");
                }
            }
        }
    }

}