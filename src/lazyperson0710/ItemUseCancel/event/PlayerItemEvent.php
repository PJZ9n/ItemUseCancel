<?php

namespace lazyperson0710\ItemUseCancel\event;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Potion;
use pocketmine\item\SplashPotion;
use pocketmine\item\VanillaItems;

class PlayerItemEvent implements Listener {

    /**
     * @param PlayerItemUseEvent $event
     * @return void
     * @priority LOW
     */
    public function onItemUse(PlayerItemUseEvent $event): void {
        if ($event->isCancelled()) return;
        $this->onItemEvents($event);
    }

    /**
     * @param PlayerInteractEvent $event
     * @return void
     * @priority LOW
     */
    public function onItemInteract(PlayerInteractEvent $event): void {
        if ($event->isCancelled()) return;
        $this->onItemEvents($event);
    }

    public function onItemEvents(PlayerItemUseEvent|PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $inHand = $player->getInventory()->getItemInHand();
        if ($player->getWorld()->getFolderName() !== "lobby") return;
        if ($inHand instanceof Potion) {
            $player->sendTip("ロビーではポーションの使用は許可されていません");
            $event->cancel();
        }
        if ($inHand instanceof SplashPotion) {
            $player->sendTip("ロビーではスプラッシュポーションの使用は許可されていません");
            $event->cancel();
        }
        $items = [
            VanillaItems::GOLDEN_APPLE()->getVanillaName(),
            VanillaItems::ENCHANTED_GOLDEN_APPLE()->getVanillaName(),
        ];
        if (in_array($inHand->getVanillaName(), $items)) {
            $player->sendTip("ロビーでは金リンゴの使用は許可されていません");
            $event->cancel();
        }
    }

}
