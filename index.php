<?php
	require_once("./_includes/php/Volume.php");
	require_once("./_includes/php/PageBuilder.php");

	// start the volume control
	$volume = new Volume;

	// build page
	$page = new PageBuilder();
	echo $page->buildPage($volume->volume);