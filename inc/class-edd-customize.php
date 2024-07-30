<?php

/**
 * Author Bytesed
 * @since 1.0.0
 * */

if (!defined('ABSPATH')){
	exit(); //exit if access directly
}

if (!class_exists('Bytesed_EDD_Customize')){
	class Bytesed_EDD_Customize{
		//$instance variable
		private static $instance;
		
		public function __construct() {
			//refresh cart after new item added in cart
			add_action('wp_ajax_bytesed_cart_load',array($this,'cart_item_refresh'));
			add_action('wp_ajax_nopriv_bytesed_cart_load',array($this,'cart_item_refresh'));
			//remove decimal
			add_filter( 'edd_sanitize_amount_decimals', array($this,'decimal_remove') );
			add_filter( 'edd_format_amount_decimals', array($this,'decimal_remove') );
			//change archive title
			add_filter( 'get_the_archive_title', array($this,'get_the_archive_title'),10, 1 );
			add_filter( 'edd_default_downloads_name', array($this,'edd_default_downloads_name'),10 );

//			add_filter( 'edd_purchase_link_defaults', array($this,'purchase_link_customize') );

		}
		/**
		 * get Instance
		 * @since 1.0.0
		 * */
		public static function getInstance(){
			if (null == self::$instance){
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * ajax cart reload
		 * @since 1.0.0
		 * */
		public function cart_item_refresh(){
		    Bytesed()->edd_cart_items();
			die();
		}

		/**
		 * decimal remove
		 * @since 1.0.0
		 * */
		public function decimal_remove() {
			return 0;
		}

		/**
		 * Add to cart button customize
		 * @since 1.0.0
		 * */
		public function edd_purchase_link_defaults($args){
			$args['price'] = false;
			$args['checkout'] = '<i class=""></i>';
			$args['text'] = '<i class=""></i>';
			return $args;
		}
		/**
		 * Change Download Archive Title
		 * @sicne 1.0.0
		 * */
		public function get_the_archive_title($title){
			if (is_post_type_archive('download')){
				$title = ucwords(str_replace('-',' ', EDD_SLUG));
			}
			return $title ;
		}

		public function edd_default_downloads_name($args){
			$args = array(
				'singular' => __( 'Our Product', 'easy-digital-downloads' ),
				'plural'   => __( 'Our Products','easy-digital-downloads' )
			);
			return $args;
		}
	}//end class
	if ( class_exists('Bytesed_EDD_Customize')){
		Bytesed_EDD_Customize::getInstance();
	}
}