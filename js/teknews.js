var $j = jQuery;

function initModalNews() {

// 	var $modalNews = $j('.tekserve-modal-newsletter-bg').detach();
// 	$j('body').prepend($modalNews);
	$j('.tekserve-modal-newsletter-link').click( function() {
	
		$j('.tekserve-modal-newsletter-bg').toggle();
		
		$j(this).toggleClass('active')
		
	}); //end $j('.tekserve-modal-newsletter-link').click( function()
	
	$j('.tekserve-modal-newsletter-window-close').click( function() {
	
		$j('.tekserve-modal-newsletter-bg').toggle();
		
		$j('.tekserve-modal-newsletter-link').toggleClass('active')
		
	}); //end $j('.tekserve-modal-newsletter-window-close').click( function()

} //end function initModalNews()