var $j = jQuery;

// Header Search Box
function initSearch () {

	$j('.tekserve-top-widget .search-link').click( function() {
		if ( $j(this).hasClass( 'active' ) ) {
		
			$j('.tekserve-top-widget .search-icons').animate({'width': '26px'});
			$j(this).animate({'width': '0', 'opacity': '0', 'padding-right': '0', 'padding-left': '0', 'margin-right': '-35px', 'color': '#fff'});
			$j('.tekserve-top-widget .tekserve_custom_search input').animate({'width': '0'});
			$j(this).removeClass('active');
			
		} 
		else {
		
			$j('.tekserve-top-widget .search-icons').animate({'width': '191px'});
			$j(this).animate({'width': '190px', 'opacity': '1', 'padding-right': '10px', 'padding-left': '10px', 'margin-right': '-35px', 'color': '#40a8c9'});
			$j('.tekserve-top-widget .tekserve_custom_search input').animate({'width': '160px'});
			$j(this).addClass('active');
			$j('.tekserve-top-widget .tekserve_custom_search input').focus();
		
		} //end if ( $j(this).hasClass( 'active' ) )
		
	}); //end $j('.tekserve-top-widget .search-link').click function() {
	
} //end function initSearch ()