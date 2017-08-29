<?php

namespace floatq\manager;

use pocketmine\level\particle\FloatingTextParticle;
use floatq\query\Query;
use pocketmine\level\Level;

class FloatManager{
	
	public function __construct(FloatingTextParticle $float, Query $query, Level $lvl){
		$this->float = $float;
		$this->query = $query;
		$this->lvl = $lvl;
	}
	
	private function getFloat(){
		return $this->float;
	}
	
	private function getQuery(){
		return $this->query;
	}
	
	private function getLevel(){
		return $this->lvl;
	}
	
	public function tick(){
		$float = $this->getFloat(); $query = $this->getQuery(); $lvl = $this->getLevel();
		$float->setTitle("".$query->getName()."");
		$float->setText("".$query->getFormatOn()."\n§e".$query->getOnlines()."§7/§e".$query->getMaxOnlines()."");
		$lvl->addParticle($float);
	}
}