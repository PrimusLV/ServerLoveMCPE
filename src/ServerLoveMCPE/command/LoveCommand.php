<?php
namespace ServerLoveMCPE\command;

use ServerLoveMCPE\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\utils\TextFormat;

class AddGroup extends Command implements PluginIdentifiableCommand
{
  
    /**
     * @param Main $plugin
     * @param $name
     * @param $description
     */
    public function __construct(Main $plugin, $name, $description, $aliases = [])
    {
        $this->plugin = $plugin;
        
        parent::__construct($name, $description);
        
        $this->setPermission("serverlove.command.love");
        
        foreach($aliases as $aliase){
          $this->setAliase($aliase);
        }
    }
    /**
     * @param CommandSender $sender
     * @param $label
     * @param array $args
     * @return bool
     */
    public function execute(CommandSender $sender, $label, array $args)
    {
        if(!$this->testPermission($sender))
            return false;
        
        // Command execution
    }
    
    public function getPlugin()
    {
        return $this->plugin;
    }
}
