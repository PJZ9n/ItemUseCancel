<?php

namespace lazyperson0710\ItemUseCancel;

use lazyperson0710\ItemUseCancel\event\PlayerItemEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    public function onEnable(): void {
        $manager = $this->getServer()->getPluginManager();
        $manager->registerEvents(new PlayerItemEvent(), $this);
    }
}
