<?php

namespace floatq\query;

class Query{
	
	const API = "https://mcapi.ca/query/{ip}:{port}/mcpe";
	const ONLINE = "§a§lOnline§r";
	const OFFLINE = "§c§lOffline§r";
	
	private $ip, $port, $name, $info;
	
	public function __construct(string $ip, int $port = 19132, string $name){
		$this->ip = $ip;
		$this->port = $port;
		$this->name = $name;
	}
	
	public function getInfo(){
       $url = $this->replace($this->ip, $this->port, self::API);
       return json_decode(file_get_contents($url),TRUE);
	}
	
	private function replace(string $ip, int $port, $url){
		$url = str_replace("{ip}", $ip, $url);
		$url = str_replace("{port}", $port, $url);
		return $url;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function setName(){
		$this->name = $name;
	}
	
	public function isOnline(){
		$info = $this->getInfo();
		if($info["status"]==1) return true; else return false;
	}
	
	public function getFormatOn(){
		if($this->isOnline()) return self::ONLINE; else return self::OFFLINE;
	}
	
	public function getOnlines(){
		$info = $this->getInfo();
		if($this->isOnline()) return $info["players"]["online"]; else return 0;
	}
	
	public function getMaxOnlines(){
		$info = $this->getInfo();
		if($this->isOnline()) return $info["players"]["max"]; else return 0;
	}
	
}