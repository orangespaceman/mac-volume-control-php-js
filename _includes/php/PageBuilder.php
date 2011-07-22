<?php 
/**
 * page builder class.  
 * build page header and footer
 *
*/
class PageBuilder {
	
	/**
	 * The constructor.
	 */
	function __construct() {
	}

	
	/**
	 * Build the page
	 */
	function buildPage($volume) {

		$return = '<!DOCTYPE html>
<html>
	<head>
		<title>Volume</title>	
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="./_includes/css/site/mobile.css" media="screen" />		
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

		<script src="http://www.google.com/jsapi"></script>
		<script>
			google.load("jquery", "1.4.2");
		</script>

		<script src="./_includes/js/site/volume.js"></script>
		<script src="./_includes/js/site/init.js"></script>
	</head>
	<body>
		<div id="horizon">
			<div id="wrapper">
				<header>
					<h1>Volume: <span id="volume-level">'.$volume.'</span>%</h1>
					<h2 id="mute" class="mute-off"><a href="#"><span></span>Mute</a></h2>
				</header>
				<ul id="vol">
		';
	
		// put in volume options
		for ($i=0; $i <= 100; $i+=10) { 
			$return .= '
					<li id="vol-'.$i.'"><a href="#"><span></span>'.$i.'</a></li>		
			';
		}
	
		$return .= '
				</ul>
			</div>
		</div>
	</body>
</html> 
		';

		return $return;
	}	
}