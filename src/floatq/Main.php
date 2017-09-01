<?php

namespace floatq;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\CallbackTask;
use floatq\query\Query;
use floatq\manager\FloatManager;
use pocketmine\math\Vector3;
use pocketmine\level\Position;
use pocketmine\level\particle\FloatingTextParticle;

class Main extends PluginBase{
	
	public $floats = [];
	
	public function onEnable(){
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask([$this, "update"]), 100);
		$lvl = $this->getServer()->getLevelByName("world");
		$coord = $lvl->getSafeSpawn();
		$this->createFloat(new Position($coord->x, $coord->y, $coord->z, $lvl), "play.lbsg.net", 19132, "§eLBSG");
		$this->createFloat(new Position($coord->x+5, $coord->y, $coord->z, $lvl), "Ksksjsjd", 19132, "§eTeste");
	}
	
	public function createFloat(Position $pos, $ip, $port, $name){
		$float = new FloatingTextParticle(new Vector3($pos->x, $pos->y, $pos->z), " ", null);
		$query = new Query($ip, $port, $name);
		$pos->level->addParticle($float);
		$this->floats[] = new FloatManager($float, $query, $pos->level);
	}
	
	public function update(){
		foreach($this->floats as $float){
			$float->tick();
		}
	}
}
