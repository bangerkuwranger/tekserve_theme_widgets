/******
	noconflict declaration
******/

var $j = jQuery;

/******
	call on jQuery loaded
*******/

$j(function() {

	if( tekserveThemeWidgetModalNews ) {
	
		initTekserveThemeWidgetModalNews();
	
	}	//end if( tekserveThemeWidgetModalNews )
	
	
	if( tekserveThemeWidgetSearch ) {
	
		initTekserveThemeWidgetSearch ();
	
	}	//end if( tekserveThemeWidgetSearch )

});	//end $j(function()