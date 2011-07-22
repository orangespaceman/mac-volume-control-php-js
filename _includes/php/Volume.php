<?php
/**
 * This class is responsible for the main functionality of the Volume control
 *
 */
class Volume {

	/*
	 *
	 */
	var $volume = 0;
	

	/*
	 *
	 */
	function __construct() {
		$this->getVolume();
	}
		
	
	/*
	 *
	 */
	function getVolume() {
		$this->volume = shell_exec('osascript -e "output volume of (get volume settings)"');
		return array("volume" => $this->volume);
	}
	
	
	/*
	 *
	 */
	function setVolume($vol) {
		shell_exec("osascript -e 'set volume output volume ".$vol."'");
		return $this->getVolume();
	}
	

	/*
	 *
	 */
	function mute() {
		shell_exec("osascript -e 'set volume output volume 0'");
		return $this->getVolume();
	}

	
	/*
	 *
	 */
	function volumeUp() {
		shell_exec("osascript -e 'set volume output volume (get (output volume of (get volume settings)) + 5)'");
		return $this->getVolume();
	}
	
	
	
	/*
	 *
	 */
	function volumeDown() {
		shell_exec("osascript -e 'set volume output volume (get (output volume of (get volume settings)) - 5)'");
		return $this->getVolume();
	}
}