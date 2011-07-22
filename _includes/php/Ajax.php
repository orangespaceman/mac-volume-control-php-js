<?php
	if (isset($_POST) && count($_POST) > 0) {

		// check what to do
		require_once("./Volume.php");
		$volume = new Volume;
		$method = $_POST['method'];
		unset($_POST['method']);
		
		// 
		switch ($method) {

			case "getVolume":
				$result = $volume->getVolume();
				echo json_encode($result);
			break;
			
			
			case "setVolume":
				$vol = intval($_POST['val']);
				$result = $volume->setVolume($vol);
				echo json_encode($result);
			break;

		}
	}
	
