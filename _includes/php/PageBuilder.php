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
		<meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <link rel="apple-touch-icon-precomposed" href="./_includes/icons/apple.png"/>

		<script src="http://www.google.com/jsapi"></script>
		<script>
			google.load("jquery", "1.6.2");
		</script>

		<script src="./_includes/js/site/volume.js"></script>
		<script src="./_includes/js/site/init.js"></script>

	</head>
	<body>
		<div id="horizon">
			<div id="wrapper">
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
				<footer>
					<h1>Volume: <span id="volume-level">'.$volume.'</span>%</h1>
					<h2 id="mute" class="mute-off"><a href="#"><span></span>Mute</a></h2>
				</footer>
			</div>
		</div>
	</body>
</html> 
		';

		return $return;
	}	
}