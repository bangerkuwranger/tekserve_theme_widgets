var $j = jQuery;

function initModalNews() {

// 	var $modalNews = $j('.tekserve-modal-newsletter-bg').detach();
// 	$j('body').prepend($modalNews);
	$j('.tekserve-modal-newsletter-link').click( function() {
	
		$j('.tekserve-modal-newsletter-bg').toggle();
		
		$j(this).toggleClass('active')
		
	}); //end $j('.tekserve-modal-newsletter-link').click( function()

} //end function initModalNews()