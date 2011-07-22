/**
 * @fileoverview Volume
 * 
 */
var volume = function(){

	// obj: volume text element
	var $volText = null,

	
	// obj: volume checking interval
	volInterval = null,

	
	// int: current volume
	currentVolume = null,
	
	
	// bool: is currently muted?
	isMuted = false,
	
	
	// int: volume before mute was pressed
	preMutedVolume = null,
	
	
	// obj: loading element
	loader = null,
	
	
	// array - volume blocks
	$volumeBlocks = null;


	/**
	 * The options passed through to this function
	 *
	 * @var Object
	 * @private
	 */
	var options = {
		
		/**
		 * The location of the AJAX script on the server
		 *
		 * @var String
		 */		
		ajaxPath : null,
		
		/**
		 * The interval time (in seconds) between volume checks
		 *
		 * 
		 */
		interval : 10
	};
	
	
	/**
	 * Initialise the functionality
	 * @param {Object} options The initialisation options
	 * @return void
	 * @public
	 */
	var init = function(initOptions) {
		
		// save any options sent through to the intialisation script, if set
		for (var option in options) {
			if (!!initOptions[option] || initOptions[option] === false) {
				options[option] = initOptions[option];
			}
			
			// error check, if no element is specified then stop
			if (!options[option] && options[option] !== false && options[option] !== 0) {
				throw('Required option not specified: ' + option);
				//return false;
			}
		}

		// get volume text element
		$volText = $("#volume-level");
		
		
		// get current volume
		currentVolume = $volText.text();
		

		// get all volume blocks
		$volumeBlocks = $("ul#vol a");
		

		// set volume controls
		$volumeBlocks.bind('click', function(e){
			e.preventDefault();
			this.blur();
			setVolumeFromBlock(this);
		});
		
		
		// set up mute
		$("h2#mute a").bind('click', function(e){
			e.preventDefault();
			this.blur();
			mutePressed(this);
		});
		
		
		// add loader
		loader = $("<span />").attr('id', 'loading').appendTo('#wrapper');
		
		
		// set up initial volume blocks
		adjustBlocks();
		
		
		// check volume every x seconds
		volInterval = setInterval(getVolume, options.interval * 1000);
	};
	
	
	/*
	 *
	 */	
	var mutePressed = function(el) {
		
		// condition : mute?
		if (!isMuted) {
			isMuted = true;
			preMutedVolume = currentVolume;
			setVolume(0);
			$(el).addClass('mute-on');
		
		// restore volume
		} else {
			isMuted = false;
			setVolume(preMutedVolume);
			preMutedVolume = null;
			$(el).removeClass('mute-on');
		}
	};
	
	
	
	/*
	 *
	 */	
	var getVolume = function() {
		_ajax("getVolume");
	};
	
	
	
	/*
	 *
	 */	
	var setVolume = function(vol) {
		_ajax("setVolume", vol);
	};
	
	
	
	/*
	 *
	 */
	var _ajax = function(method, val) {
	
		showLoader();
		
		var postData, response;

		postData = 'method='+method;
		
		if (!!val) {
			postData += '&val='+val;
		}
		
		postData += '&random='+Math.random();

		// submit request
		response = $.post(
			options.ajaxPath,
			postData,
			function(data, textStatus){

				var result = $.parseJSON(data);
				currentVolume = result.volume;
				$volText.text(result.volume);
				
				adjustBlocks();
				
				hideLoader();

				//console.log(result);

			});
	};
	
	
	/*
	 *
	 */
	var adjustBlocks = function() {
	
		$volumeBlocks.each(function(counter){
			var $block = $(this);
			var blockVolume = parseInt($block.parent().attr('id').split('-')[1], 10);
			if ((blockVolume-2) <= currentVolume) {
				$block.parent().addClass('active');
			} else {
				$block.parent().removeClass('active');
			}
		});
	};
	
	
	/*
	 *
	 */
	var setVolumeFromBlock = function(el) {
		$block = $(el);
		var blockVolume = parseInt($block.parent().attr('id').split('-')[1], 10);
		setVolume(blockVolume);
	};
	
	
	/*
	 *
	 */
	var showLoader = function() {
	
		loader.addClass('show');
		
	};
	
	
	
	/*
	 *
	 */
	var hideLoader = function() {
	
		loader.removeClass('show');
		
	};

	

	/**
	 * Return value, expose certain methods above
	 */
	return {
		init: init
	};
}();