var $j = jQuery;

var tekserveThemeWidgetModalNews = true;

function initTekserveThemeWidgetModalNews() {

	$j('.tekserve-modal-newsletter-link').click( function() {
	
		$j('.tekserve-modal-newsletter-bg').toggle();
		$j(this).toggleClass('active');
		$j('.tekserve-modal-window-form .mc_error_msg').text('');
		
	}); //end $j('.tekserve-modal-newsletter-link').click( function()
	
	$j('.tekserve-modal-newsletter-window-close').click( function() {
	
		$j('.tekserve-modal-newsletter-bg').toggle();
		$j('.tekserve-modal-newsletter-link').toggleClass('active');
		
	}); //end $j('.tekserve-modal-newsletter-window-close').click( function()
	
	if ($j('.date-pick, .birthdate-pick').length > 0) {
	
		$j('.date-pick, .birthdate-pick').datepicker();
	
	}	//end if ($j('.date-pick, .birthdate-pick').length > 0)

} //end initTekserveThemeWidgetModalNews()