var $j = jQuery;

var tekserveThemeWidgetSearch = true;

// Header Search Box
function initTekserveThemeWidgetSearch () {

	$j('.tekserve-top-widget .search-link').click( function() {
		if ( $j(this).parent().hasClass( 'active' ) ) {
			var search = $j('.tekserve_custom_search input[type="text"]').val();
			
			if ( search != '' && search != 'Find…' ) {
			
				window.location.href = "http://shop.tekserve.com/catalogsearch/result/?q=" + search;
				
			}
			
			else {
				if ( $j('.tekserve-top-widget .searchlink').hasClass('mobile') ) {
				
					$j('.tekserve-top-widget .searchlink').appendTo('.tekserve-top-widget .search-icons');
									$j('.tekserve-top-widget .tekserve_custom_search').css({'display': 'inline'});
				
				} //end if ( $j('.tekserve-top-widget .searchlink').hasClass('mobile') )
				$j('.tekserve-top-widget .tekserve_custom_search input, .tekserve-top-widget .search-icons .tekserve_custom_search').animate({'width': '0', 'padding': '0', 'margin-right': '0', 'background-color': '#004d72'}, 'fast', function() {
				
					$j('.tekserve-top-widget .search-icons .searchlink').removeClass('active');
				
				}); //end .animate( function()
				
			} //end if ( search != '' && search != 'Find…' )
		
		} 
		
		else {
			if ( $j('.tekserve-top-widget .searchlink').hasClass('mobile') ) {
				
				$j('.tekserve-top-widget .searchlink').appendTo('.tekserve-top-widget .tekserve_custom_search');
				$j('.tekserve-top-widget .tekserve_custom_search').css({'display': 'block'});
				
			} //end if ( $j('.tekserve-top-widget .searchlink').hasClass('mobile') )
			$j('.tekserve-top-widget .tekserve_custom_search').css({'margin-right': '1em'});
			$j('.tekserve-top-widget .tekserve_custom_search input').css({'padding': '.25em .5em'});
			$j('.tekserve-top-widget .tekserve_custom_search input, .tekserve-top-widget .search-icons .tekserve_custom_search').animate({'width': '180px'}, 'fast');
			$j(this).parent().addClass('active');
			$j('.tekserve-top-widget .tekserve_custom_search input').animate({'background-color': '#fff'}, 'fast').focus();
		
		} //end if ( $j(this).parent().hasClass( 'active' ) )
		
	}); //end $j('.tekserve-top-widget .search-link').click function()
	
	$j('.tekserve-top-widget .contact-link').hover( function() {
		$j('.tekserve-top-widget .contact-link .hoverstate').animate({opacity:1}, 250);
	},function(){
	  $j('.tekserve-top-widget .contact-link .hoverstate').animate({opacity:0}, 250);
	});
	
} //end function initSearch ()