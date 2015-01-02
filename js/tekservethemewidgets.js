/******
	noconflict declaration
******/

var $j = jQuery;

/******
	call on jQuery loaded
*******/

$j(function() {

	if( typeof( tekserveThemeWidgetModalNews ) !== 'undefined' ) {
	
		initTekserveThemeWidgetModalNews();
	
	}	//end if( tekserveThemeWidgetModalNews )
	
	
	if( typeof( tekserveThemeWidgetSearch ) !== 'undefined' ) {
	
		initTekserveThemeWidgetSearch ();
	
	}	//end if( tekserveThemeWidgetSearch )

});	//end $j(function()