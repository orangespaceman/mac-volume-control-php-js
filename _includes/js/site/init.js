/**
 * Site global JS file
 */

	/**
	 * on Dom ready functionality
	 */
		$(document).ready(function() {
		
			// add an extra class to the <body> element for JS-only styling
			$("body").addClass("js");
	
	        // hide scroll bar
	        window.scrollTo(0,1);
	
			// init vol control
			volume.init({
				ajaxPath: "./_includes/php/Ajax.php",
				interval: 10
			});
		});


	/*
	 * Window load calls for all pages
	 */
		$(window).load(function() {
			
		});