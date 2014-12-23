<?php
/**
 * Plugin Name: Tekserve Theme Widgets
 * Plugin URI: https://github.com/bangerkuwranger
 * Description: Wordpress plugin that adds search and contact widgets to the theme.
 * Version: 1.0
 * Author: Chad A. Carino
 * Author URI: http://www.chadacarino.com
 * License: MIT
 */
/*
The MIT License (MIT)
Copyright (c) 2014 Chad A. Carino
 
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

/** widget to display search, account, and contact links **/

class Tekserve_Contact_Search_Widget extends WP_Widget {

	public function __construct() {
		
		// widget actual processes
		parent::__construct(
			'tekserve_top_widget', // Base ID
			__('Tekserve Contact Search'), // Name
			array( 'description' => 'Display Search, Account, and Contact Links' ) // Args
		);
		
		// include js
		add_action('wp_enqueue_scripts', array(&$this, 'js'));
		
	} //end function __construct()

	public function widget( $args, $instance ) {
	
		extract( $args );
		
		// these are the widget options
		$accounturl = $instance['accounturl'];
		$contacturl = $instance['contacturl'];
		
		echo $before_widget;

		echo '<div class="tekserve-top-widget">';
		
		echo '<ul class="social-icons search-icons">';
		
		echo '<li>';
		echo '<a href="' . $accounturl . '" class="account-link" title="Go to your account">';
		echo '	<i class="fa fa-user"></i>';
		echo '</a>';
		echo '</li>';
		
		echo '<li class="tekserve_custom_search custom-search right search"><form method="get" autocomplete="off" class="searchform search-form" action="" role="search"><input type="text" autocomplete="on" value="Find…" name="s" class="s search-input" onfocus="if (this.value == \'Find…\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'Find…\';}"><input type="submit" class="searchsubmit search-submit" style="display:none !important;"value="GO"></form></li>';
		
		echo '<li class="searchlink">';
		echo '<a href="javascript:;" class="search-link" title="Search Tekserve for products and information">';
		echo '	<i class="fa fa-search"></i>';
		echo '</a>';
		echo '</li>';
		
		echo '</ul>';
		
		echo '<div><a class="contact-link" title="Contact us via phone or email" href="' . $contacturl . '"><img class="defaultstate" src="' . plugins_url( '/img/contact-us.svg' , __FILE__ ) . '" /><img class="hoverstate" src="' . plugins_url( '/img/contact-us-hover.svg' , __FILE__ ) . '" /></a></div>';
		
		echo '</div>';
		
		echo $after_widget;
		
	} //end function widget( $args, $instance ) 

 	public function form( $instance ) {
		// outputs the options form on admin
		
		// check values
		if( $instance) {
		
			 $accounturl = esc_textarea($instance['accounturl']);
			 $contacturl = esc_textarea($instance['contacturl']);
			 
		} 
		else {
		
			 $accounturl = 'http://shop.tekserve.com/customer/account';
			 $contacturl = '/about-us/contact-us/';
			 
		} //end if( $instance)
		
		//generate form for widget admin
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('accounturl'); ?>">URL for Account link</label>
			<input id="<?php echo $this->get_field_id('accounturl'); ?>" name="<?php echo $this->get_field_name('accounturl'); ?>" type="url" value="<?php echo $accounturl?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('contacturl'); ?>">URL for Contact Us link</label>
			<input id="<?php echo $this->get_field_id('contacturl'); ?>" name="<?php echo $this->get_field_name('contacturl'); ?>" type="text" value="<?php echo $contacturl; ?>" />
		</p>
		<?php
	}


	public function update( $new_instance, $old_instance ) {
	
		// processes widget options to be saved
		$instance = $old_instance;
		
    	// Fields
    	$instance['contacturl'] = strip_tags($new_instance['contacturl']);
    	$instance['accounturl'] = strip_tags($new_instance['accounturl']);
    	
    	return $instance;
    	
	} //end function update( $new_instance, $old_instance )
	
	public function js() {
	
		// enqueues scripts if present
		if ( is_active_widget( false, false, $this->id_base, true ) ) {
	   
		   wp_enqueue_script( 'teksearch', plugins_url( '/js/teksearch.js' , __FILE__ ), array( 'jquery' ) );
	   
		}  //end if ( is_active_widget ... )  
    
    } //end function js()
	
} //end class Tekserve_Contact_Search_Widget



/** widget to display link and modal for newsletter signup **/

class Tekserve_Modal_Newsletter_Widget extends WP_Widget {

	public function __construct() {
	
		// widget actual processes
		parent::__construct(
			'tekserve_newsletter_widget', // Base ID
			__('Tekserve Modal Newsletter Sign-Up Form'), // Name
			array( 'description' => 'Generates a link to a modal window that contains the newsletter sign-up form' ) // Args
		);
		
		// include js
		add_action('wp_enqueue_scripts', array(&$this, 'js'));
		
	} //end function __construct()

	public function widget( $args, $instance ) {
	
		extract( $args );
		
		// these are the widget options
		if( $instance['modalcode'] ) {
		
			$modalcode = base64_decode( $instance['modalcode'] );
			
		}
		else {
		
			$modalcode = '<iframe class="pardotform" src="http://rsvp.tekserve.com/l/34292/2014-07-16/2hft7" width="100%" height="500" type="text/html" frameborder="0" allowtransparency="true" style="border: 0"></iframe>';
	
		}
		
		
		echo $before_widget;
		
		// Display the widget
		
		//link to display modal
		echo '<div class="tekserve-modal-newsletter-link">';
		echo ' <i class="fa fa-envelope-o"></i> SUBSCRIBE';
		echo '</div>';
		
		//the modal iteself
		echo '<div class="tekserve-modal-newsletter-bg" style="display:none;">';
		echo '<div class="tekserve-modal-newsletter-window style="height:0;">';
		echo '<div class="tekserve-modal-newsletter-window-close"><i class="fa fa-times-circle"></i></div>';
		echo $modalcode;
		echo '</div>';
		echo '</div>';
		
		echo $after_widget;
		
	} //end public function widget( $args, $instance )

 	public function form( $instance ) {
 	
		// outputs the options form on admin
		
		// check values
		if( $instance) {
			 $id = base64_decode($instance['modalcode']);
		} else {
			 $modalcode='<iframe class="pardotform" src="http://rsvp.tekserve.com/l/34292/2014-07-16/2hft7" width="100%" height="500" type="text/html" frameborder="0" allowtransparency="true" style="border: 0"></iframe>';
		}
		?>
	
		<p>
			<label for="<?php echo $this->get_field_id('modalcode'); ?>">Enter html for newsletter contact form</label>
			<textarea  id="<?php echo $this->get_field_id('modalcode'); ?>" name="<?php echo $this->get_field_name('modalcode'); ?>" >
				<?php echo $modalcode ?>
			</textarea>
		</p>
		<?php
	}


	public function update( $new_instance, $old_instance ) {
	
		// processes widget options to be saved
		$instance = $old_instance;
    	// Fields
    	$instance['modalcode'] = base64_encode($new_instance['modalcode']);
    	return $instance;
	}
	
	public function js() {
		// enqueues scripts if present
		if ( is_active_widget( false, false, $this->id_base, true ) ) {
	   
		   wp_enqueue_script( 'teknews', plugins_url( '/js/teknews.js' , __FILE__ ), array( 'jquery' ) );
		   wp_enqueue_style( 'teknewscss', plugins_url( '/teknews.css' , __FILE__ ) );
	   
		}  //end if ( is_active_widget ... )  
    
    } //end function js()
	
} //end class Tekserve_Modal_Newsletter_Widget



/** register widgets with wp **/

add_action( 'widgets_init', function(){

     register_widget( 'Tekserve_Contact_Search_Widget' );
     register_widget( 'Tekserve_Modal_Newsletter_Widget' );
     
}); //end add_action( 'widgets_init', function()

/**	enqueue init script	**/

wp_enqueue_script( 'tekservethemewidgets', plugins_url( '/js/tekservethemewidgets.js' , __FILE__ ), array( 'jquery' ) );