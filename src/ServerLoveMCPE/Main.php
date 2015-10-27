<?php
namespace ServerLoveMCPE;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
class Main extends PluginBase implements Listener{
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->nolove = new Config($this->getDataFolder()."nolove.txt", Config::ENUM);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->getLogger()->info(TextFormat::RED . " Yayyy, ServerLoveMCPE is ready for love on Version 1.3.0!");
    }
    public function onDisable(){
        $this->nolove->save();
    }
    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        switch($command->getName()){
            case "love":
                if(!(isset($args[0]))){
                    return false;
                }
                $loved = array_shift($args);
                if($this->nolove->exists(strtolower($loved))){
                    $sender->sendMessage("§5 You can't love " . $loved . " §5  GET OVER IT");
                    return true;
                }else{
                    $lovedPlayer = $this->getServer()->getPlayer($loved);
                    if($lovedPlayer !== null and $lovedPlayer->isOnline()){
                        $lovedPlayer->sendMessage($sender->getName()."§5 is your lover lover!");
                        if(isset($args[0])){
                            $lovedPlayer->sendMessage("Reason: " . implode(" ", $args));
                        }
                        $sender->sendMessage("§5Wait till everyone finds out you LOVE " . $loved . " §dTheys gonna be like, I KNEW IT");
                        return true;
                    }else{
                        $sender->sendMessage($loved . "§5 is not avalible for love. #shameful. §4 HA YOUR NOW A LONER!");
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
            case "ServerLoveMCPE":
                $sender->sendMessage("§5[ServerLoveMCPE] ServerLoveMCPE is a plugin that brings a little love to a server. ");
                $sender->sendMessage("§d[ServerLoveMCPE] ServerLoveMCPE ( For MCPE) Made By TheDeibo ");
                $sender->sendMessage("§5[ServerLoveMCPE] Original ServerLove (For MCPC )  Made By ratchetgame98 ");
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
}
