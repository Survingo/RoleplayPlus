<?php

namespace Survingo\RoleplayPlus;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\level\Position;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\level\ChunkLoadEvent;
use pocketmine\level\generator\biome\Biome;
use pocketmine\network\protocol\LevelEventPacket;

class RoleplayPlus extends PluginBase implements Listener {
	
	public function onEnable() {
	$this->saveResource("config.yml");	
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
	}
	public function onPlayerJoinEvent(PlayerJoinEvent $event) {
if ($this->getConfig()->get("allowWeather") === true) {
		$player = $event->getPlayer ();
		$pk = new LevelEventPacket ();
		$pk->evid = 3001;
		$pk->data = 10000;
		$player->dataPacket ( $pk );
	}
}
	public function onChunkLoadEvent(ChunkLoadEvent $event) {
			if ($this->getConfig()->get("RainInWorld") === true) {
			for($x = 0; $x < 16; ++ $x)
			        for($z = 0; $z < 16; ++ $z)			
				        $event->getChunk ()->setBiomeId ( $x, $z, Biome::TAIGA );
}
			elseif ($this->getConfig()->get("SnowInWorld") === true) {
			for($x = 0; $x < 16; ++ $x)
			        for($z = 0; $z < 16; ++ $z)			
			                $event->getChunk ()->setBiomeId ( $x, $z, Biome::ICE_PLAINS );	
			}	
	}

public function onCommand(CommandSender $sender, Command $command, $label, array $args)
    {
        switch (strtolower($command->getName())) {
            case "rpp":
                if ($sender instanceof Player) {
                    if (!(isset($args[0]))) {
                        if ($sender->hasPermission("rpp.command.main")) {
                            $sender->sendMessage("[§6Roleplay§4Plus§f] Use /rpp help");
                            return true;
                        } else {
                            $sender->sendMessage("You don't have the permission to do that!");
                            return true;
                        }
                    }
$arg = array_shift($args);
                    switch ($arg) {
                        
case "invisible":
                            if ($sender->hasPermission("rpp.command.invisible")) {
			$sender->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_INVISIBLE, true);
			$sender->setDataProperty(Entity::DATA_SHOW_NAMETAG, Entity::DATA_TYPE_BYTE, 0);
		
                                return true;
                            } else {
                                $sender->sendMessage("You don't have the permission to do that!");
                            }
                            return true;
                            break;
case "visible":
                            if ($sender->hasPermission("rpp.command.visible")) {
			$sender->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_INVISIBLE, false);
			$sender->setDataProperty(Entity::DATA_SHOW_NAMETAG, Entity::DATA_TYPE_BYTE, 1);
		
                                return true;
                            } else {
                                $sender->sendMessage("You don't have the permission to do that!");
                            }
                            return true;
                            break;

case "version":
                            if ($sender->hasPermission("rpp.command.version")) {
			$sender->sendMessage("[§6Roleplay§4Plus§f] ".  $this->getDescription()->getFullName() . " by Survingo");
		
                                return true;
                            } else {
                                $sender->sendMessage("You don't have the permission to do that!");
                            }
                            return true;
                            break;
case "help":
                            if ($sender->hasPermission("rpp.command.help")) {
			$sender->sendMessage("[§6Roleplay§4Plus§f] Sub-Commands:");
$sender->sendMessage("§6/rpp help §fShows the help");
$sender->sendMessage("§6/rpp version §fShows current version");
$sender->sendMessage("§6/rpp invisible §fMakes you invisible!");
$sender->sendMessage("§6/rpp visible §fMakes you re-visible for all");
		
                                return true;
                            } else {
                                $sender->sendMessage("You don't have the permission to do that!");
                            }
                            return true;
                            break;
}
}
}
}
}
