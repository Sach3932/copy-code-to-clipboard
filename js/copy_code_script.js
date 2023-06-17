jQuery( document ).ready(function() {
	
	var copy_text_label = copyScript.copy_text_label;
	var copied_text_label = copyScript.copied_text_label;
	var copy_text_label_safari = copyScript.copy_text_label_safari;
	var copy_text_label_other_browser = copyScript.copy_text_label_other_browser;
	var copy_code_block_background = copyScript.copy_code_block_background;
	var copy_code_block_text_color = copyScript.copy_code_block_text_color;
	var copy_button_background = copyScript.copy_button_background;
	var copy_button_text_color = copyScript.copy_button_text_color;
	
	if (copy_text_label == '') {
	  var copy_text_label = 'Copy';
	}
	if (copied_text_label == '') {
	  var copied_text_label = 'Copied';
	}
	if (copy_text_label_safari == '') {
	  var copy_text_label_safari = 'Press "⌘ + C" to copy';
	}
	if (copy_text_label_other_browser == '') {
	  var copy_text_label_other_browser = 'Press "Ctrl + C" to copy';
	}
	if (copy_button_background == '') {
	  var copy_button_background = '#000000';
	}
	if (copy_button_text_color == '') {
	  var copy_button_text_color = '#ffffff';
	}
	//console.log(copy_code_block_background);
	function GetCssMap(mapIdentifier) {
		return { "background-color" :  copy_code_block_background }
	}

	var copyButton = '<div class="btn-clipboard" style="color:'+copy_button_text_color+'; background-color:'+copy_button_background+';" title="" data-original-title="Copy to clipboard">'+copy_text_label+'</div>';
	jQuery('pre').each(function(){
		
		jQuery(this).wrap( '<div class="PreCodeWrapper"/>');
		jQuery(this).css( 'padding', '2.75rem' );
		jQuery(this).css( 'color', copy_code_block_text_color );
		jQuery(this).css( 'background', copy_code_block_background );
		
	});
	jQuery('div.PreCodeWrapper').prepend(jQuery(copyButton)).children('.btn-clipboard').show();
  
  
  // Run Clipboard
  var copyCode = new ClipboardJS('.btn-clipboard', {
    target: function(trigger) {
      return trigger.nextElementSibling;
    }
  });
  
  // On success:
  // - Change the "Copy" text to "Copied".
  // - Swap it to "Copy" in 2s.
  // - Lead user to the "contenteditable" area with Velocity scroll.
  
  copyCode.on('success', function(event) {
    event.clearSelection();
    event.trigger.textContent = copied_text_label;
    window.setTimeout(function() {
      event.trigger.textContent = copy_text_label;
    }, 2000);
    /* $.Velocity(pasteContent, 'scroll', { 
      duration: 1000 
    }); */
  });
  // On error (Safari):
  // - Change the  "Press Ctrl+C to copy"
  // - Swap it to "Copy" in 2s.
  copyCode.on('error', function(event) { 
     var is_safari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
	 
	if (is_safari) {
			event.trigger.textContent = copy_text_label_safari;
		}
		else if(navigator.userAgent.match(/ipad|ipod|iphone/i)){
			event.trigger.textContent = copy_text_label_other_browser;
		}
		else{
			event.trigger.textContent = copy_text_label_other_browser;
		}
	
    window.setTimeout(function() {
      event.trigger.textContent = copy_text_label;
    }, 5000);
  });
  
});