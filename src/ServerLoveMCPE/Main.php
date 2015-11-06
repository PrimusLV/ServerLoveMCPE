<?php
namespace ServerLoveMCPE;

use pocketmine\plugin\PluginBase;

use ServerLoveMCPE\handler\EventListener;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

use pocketmine\Player;
use pocketmine\IPlayer;

class Main extends PluginBase {
    
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        @mkdir($this->getDataFolder());
        $this->nolove = new Config($this->getDataFolder()."nolove.txt", Config::ENUM);
        $this->saveDefaultConfig();
        $this->getLogger()->info(TextFormat::RED . " Yayyy, ServerLoveMCPE is ready for love on Version ".$this->getDescription()->getVersion());
    
        $this->registerCommands();
        
    }
    
    public function onDisable()
    {
        $this->nolove->save();
    }
    
    private function registerCommands(){
        $commandMap = $this->getServer()->getCommandMap();
        
        $commandMap->register('love', new LoveCommand($this, 'love', '__DESCRIPTION', ['lov', 'luv']), null);
        $commandMap->register('nolove', new NoLoveCommand($this, 'nolove', '__DESCRIPTION', ['nl', 'nol', 'nlove']), null);
    }
    
    /**
     * @param CommandSender $sender
     * @param Command $command
     * @param string $label
     * @param array $args
     * 
     * @return bool
     */
    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        switch(strtolower($command->getName()){
            case "love":
                if(!(isset($args[0]))){
                    return false;
                }
                $loved = array_shift($args);
                if($this->nolove->exists(strtolower($loved))){
                    $sender->sendMessage("§5 Sorry," . $loved . " §5  is not interested in you.");
                    return true;
                }else{
                    $lovedPlayer = $this->getServer()->getPlayer($loved);
                    if($lovedPlayer !== null and $lovedPlayer->isOnline()){
                        $lovedPlayer->sendMessage($sender->getName()."§5 is in love with you!");
                        if(isset($args[0])){
                            $lovedPlayer->sendMessage("Reason: " . implode(" ", $args));
                        }
                        $sender->sendMessage("§5So you love " . $loved . "?§5 Awww, thats nice.");
                        $this->getServer()->broadcastMessage("§a" . $sender->getName() . " §5is in love with §a" . $loved . "§5.");
                        return true;
                    }else{
                        $sender->sendMessage($loved . "§5 is not avalible for love. #shameful. §5 Basically, " . $loved . " §5is not interested in you.");
                        return true;
                    }
                }
            break;
            case "nolove":
                if(!(isset($args[0]))){
                    return false;
                }
                if($args[0] == "nolove"){
                    $this->nolove->set(strtolower($sender->getName()));
                    $sender->sendMessage("§5You will no longer be loved. §e#ForEverAlone");
                    return true;
                }elseif($args[0] == "love"){
                    $this->nolove->remove(strtolower($sender->getName()));
                    $sender->sendMessage("§5You will now be loved again! §e#GetInThere");
                    return true;
                }else{
                    return false;
                }
            break;
            case "serverlove":
                $sender->sendMessage("§5[ServerLoveMCPE] ServerLoveMCPE is a plugin that brings a little love to a server. ");
                $sender->sendMessage("§5[ServerLoveMCPE] Original ServerLove (For MCPC )  Made By ratchetgame98 ");
                $sender->sendMessage(" ");
                $sender->sendMessage("§d[ServerLoveMCPE] Usage: /love <playerName>");
                $sender->sendMessage("§5[ServerLoveMCPE] Usage: /nolove <nolove|love> ");
                $sender->sendMessage("§d[ServerLoveMCPE] Happy Loving!");
                return true;
            break;
        default:
            return false;
        }
    return false;
    }
    // TODO Remove onCommand() and use $commandMap->registerCommand()
    
    
    /**      ___       ______    __  
    *       /   \     |   _  \  |  | 
    *      /  ^  \    |  |_)  | |  | 
    *     /  /_\  \   |   ___/  |  | 
    *    /  _____  \  |  |      |  | 
    *   /__/     \__\ | _|      |__| 
    */
    
    /**
     * @param IPlayer $player
     * 
     * @return bool
     */
    public function isMarried(IPlayer $player)
    {
     // TODO    
    }
    
    /**
     * @param IPlayer $player
     * 
     * @return IPlayer|null
     */
    public function getMarriagePartner(IPlayer $player){
        // TODO
    }
    /**
     * @param IPlayer $wife
     * @param IPlayer $husband
     * @description Returns true on success, false on fail
     * 
     * @return bool
     */
    public function merry(IPlayer $wife, IPlayer $husband)
    {
     // TODO
    }
    
    /**
     * @param IPlayer $player
     * @description Returns true if $player is dating someone or false if not are is married
     * 
     * @return bool
     */
    public function isDating(IPlayer $player)
    {
     // TODO
    }
    
    /**
     * @param IPlayer $player
     * 
     * @return IPlayer|null
     */
    public function getDatePartner(IPlayer $player)
    {
     // TODO
     // Better name
    }
    
}
