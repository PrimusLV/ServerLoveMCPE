<?php
namespace ServerLoveMCPE\handler;

use ServerLoveMCPE\Main;

use pocketmine\event\Listener;

class EventListener {

  private $plugin;

  public function __construct(Main $plugin)
  {
    $this->plugin = $plugin;
  }


}
