<?php
/**
 * Plugin Name: Tekserve Theme Widgets
 * Plugin URI: https://github.com/bangerkuwranger
 * Description: Wordpress plugin that adds search and contact widgets to the theme.
 * Version: 1.1
 * Author: Chad A. Carino
 * Author URI: http://www.chadacarino.com
 * License: MIT
 */
/*
The MIT License (MIT)
Copyright (c) 2015 Chad A. Carino
 
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
		add_action( 'wp_enqueue_scripts', array( &$this, 'js' ) );
		
	} //end __construct()
	
	

	public function widget( $args, $instance ) {
	
		extract( $args );
		
		// these are the widget options
		$accounturl = $instance['accounturl'];
		$contacturl = $instance['contacturl'];
		
		echo $before_widget;
		echo '
		<div class="tekserve-top-widget">
			<ul class="social-icons search-icons">
				<li>
					<a href="' . $accounturl . '" class="account-link" title="Go to your account">
						<i class="fa fa-user"></i>
					</a>
				</li>
				<li class="tekserve_custom_search custom-search right search">
					<form method="get" autocomplete="off" class="searchform search-form" action="" role="search">
						<input type="text" autocomplete="on" value="Find…" name="s" class="s search-input" onfocus="if (this.value == \'Find…\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'Find…\';}">
						<input type="submit" class="searchsubmit search-submit" style="display:none !important;"value="GO">
					</form>
				</li>
				<li class="searchlink">
					<a href="javascript:;" class="search-link" title="Search Tekserve for products and information">
						<i class="fa fa-search"></i>
					</a>
				</li>
			</ul>
			<div>
				<a class="contact-link" title="Contact us via phone or email" href="' . $contacturl . '">
					<img class="defaultstate" src="' . plugins_url( '/img/contact-us.svg' , __FILE__ ) . '" />
					<img class="hoverstate" src="' . plugins_url( '/img/contact-us-hover.svg' , __FILE__ ) . '" />
				</a>
			</div>
		</div>';
		echo $after_widget;
		
	} //end widget( $args, $instance ) 
	
	

 	public function form( $instance ) {
 	
		// outputs the options form on admin
		// check values
		if( $instance) {
		
			 $accounturl = esc_textarea( $instance['accounturl'] );
			 $contacturl = esc_textarea( $instance['contacturl'] );
			 
		} 
		else {
		
			 $accounturl = 'http://shop.tekserve.com/customer/account';
			 $contacturl = 'http://www.tekserve.com/about-us/contact-us/';
			 
		} //end if( $instance)
		
		//generate form for widget admin
		echo '
		<p>
			<label for="' . $this->get_field_id( 'accounturl' ) . '">URL for Account link</label>
			<input id="' . $this->get_field_id( 'accounturl' ) . '" name="' . $this->get_field_name( 'accounturl' ) . '" type="url" value="' . $accounturl . '" />
		</p>
		<p>
			<label for="' . $this->get_field_id( 'contacturl' ) . '">URL for Contact Us link</label>
			<input id="' . $this->get_field_id( 'contacturl' ) . '" name="' . $this->get_field_name( 'contacturl' ) . '" type="text" value="' . $contacturl . '" />
		</p>';
		
	}	//end form( $instance )
	


	public function update( $new_instance, $old_instance ) {
	
		// processes widget options to be saved
		$instance = $old_instance;
		
    	// Fields
    	$instance['contacturl'] = strip_tags( $new_instance['contacturl'] );
    	$instance['accounturl'] = strip_tags( $new_instance['accounturl'] );
    	
    	return $instance;
    	
	} //end update( $new_instance, $old_instance )
	
	
	
	public function js() {
	
		// enqueues scripts if present
		if( is_active_widget( false, false, $this->id_base, true ) ) {
	   
		   wp_enqueue_script( 'teksearchjs', plugins_url( '/js/teksearch.js' , __FILE__ ), array( 'jquery' ) );
	   
		}  //end if( is_active_widget( false, false, $this->id_base, true ) ) )  
    
    } //end js()
    
    
	
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
		add_action( 'wp_enqueue_scripts', array( &$this, 'js' ) );
		
	}	//end __construct()
	
	

	public function widget( $args, $instance ) {
	
		extract( $args );
		
		// these are the widget options
		if( $instance['modalcode'] ) {
		
			$modalcode = trim( base64_decode( $instance['modalcode'] ) );
			
		}
		else {
		
			$modalcode = '<h4>Get Tekserve\'s Newsletter for Technology Tips &amp; Free Events</h4>';
	
		}	//end if( $instance['modalcode'] )
		
		
		echo $before_widget;
		
		// Display the widget
		
		//link to display modal
		echo '
		<div class="tekserve-modal-newsletter-link">
			<i class="fa fa-envelope-o"></i> SUBSCRIBE
		</div>';
		
		//the modal iteself
		echo '
		<div class="tekserve-modal-newsletter-bg" style="display:none;">
			<div class="tekserve-modal-newsletter-window style="height:0;">
				<div class="tekserve-modal-newsletter-window-close">
					<i class="fa fa-times-circle"></i>
				</div>
				<div class="tekserve-modal-window-form">' . $modalcode;
				mailchimpSF_signup_form();
				echo '
				</div>
			</div>
		</div>';
		
		echo $after_widget;
		
	}	//end widget( $args, $instance )
	
	

 	public function form( $instance ) {
 	
		// outputs the options form on admin
		
		// check values
		if( $instance) {
		
			 $modalcode = trim( base64_decode( $instance['modalcode'] ) );
		
		}
		else {
		
			 $modalcode = '<h4>Get Tekserve\'s Newsletter for Technology Tips &amp; Free Events</h4>';
		
		}	//end if( $instance)
		
		//output form
		echo '
		<p>
			<label for="' . $this->get_field_id( 'modalcode' ) . '">Enter html above newsletter contact form:</label>
			<textarea  style="width: 100%; min-height: 10em;" id="' . $this->get_field_id( 'modalcode' ) . '" name="' . $this->get_field_name( 'modalcode' ) . '" >' . $modalcode . '</textarea>
		</p>';
		
	}	//end form( $instance )




	public function update( $new_instance, $old_instance ) {

		// processes widget options to be saved
		$instance = $old_instance;
    	// Fields
    	$instance['modalcode'] = base64_encode( trim( $new_instance['modalcode'] ) );
    	return $instance;

	}	//end update( $new_instance, $old_instance )
	
	
	
	public function js() {
	
		// enqueues scripts if present
		if( is_active_widget( false, false, $this->id_base, true ) ) {
	   
		   wp_enqueue_script( 'teknewsjs', plugins_url( '/js/teknews.js' , __FILE__ ), array( 'jquery' ) );
		   wp_enqueue_style( 'teknewscss', plugins_url( '/css/teknews.css' , __FILE__ ) );
	   
		}  //end if( is_active_widget( false, false, $this->id_base, true ) ) 
    
    } //end js()
    
    
	
} //end class Tekserve_Modal_Newsletter_Widget






/** register widgets with wp **/

add_action( 'widgets_init', function(){

     register_widget( 'Tekserve_Contact_Search_Widget' );
     register_widget( 'Tekserve_Modal_Newsletter_Widget' );
     
}); //end add_action( 'widgets_init', function()




/**	enqueue init script	**/

wp_enqueue_script( 'tekservethemewidgets', plugins_url( '/js/tekservethemewidgets.js' , __FILE__ ), array( 'jquery' ) );