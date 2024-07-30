<?php

/**
 * Author Bytesed
 * @since 1.0.0
 * */

if ( ! defined( 'ABSPATH' ) ) {
	exit(); //exit if access directly
}
if ( ! class_exists( 'Bytesed_Ajax_Request' ) ) {
	class Bytesed_Ajax_Request {

		//$instance variable
		private static $instance;

		private function __construct() {
			add_action( 'wp_ajax_bytesed_item_support_mail', array( $this, 'item_support_mail_send' ) );
			add_action( 'wp_ajax_nopriv_bytesed_item_support_mail', array( $this, 'item_support_mail_send' ) );

			//setup smtp
//			add_action( 'phpmailer_init', array( $this, 'configure_smtp' ) );
//
//			//mailing settings
//			remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
//			add_filter( 'wp_mail_content_type', array( $this, 'set_html_content_type' ) );

		}

		/**
		 * get Instance
		 * @since 1.0.0
		 * */
		public static function getInstance() {
			if ( null == self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * item support mail send
		 * @since 1.0.0
		 * */
		public function item_support_mail_send() {
			wp_mail("rsharifur824@gmail.com","Email Subject", "<html>
 <head>
     <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
 </head>
 <body>
     <p>Hello World! This is HTML...</p> 
 </body>
 </html>");

			die();
		}

		/**
		 * set mail type
		 * @since 1.0.0
		 * */
		function set_html_content_type() {
			return 'text/html';
		}

		/**
		 * configure smtp
		 * @since 1.0.0
		 * */
		public function configure_smtp( PHPMailer $phpmailer ) {
			$phpmailer->isSMTP(); //switch to smtp
			$phpmailer->Host       = cs_get_option('smtp_host');
			$phpmailer->SMTPAuth   = true;
			$phpmailer->Port       = cs_get_option('smtp_port');
			$phpmailer->Username   = cs_get_option('smtp_username');
			$phpmailer->Password   = cs_get_option('smtp_password');
			$phpmailer->SMTPSecure = false;
			$phpmailer->From       = cs_get_option('from_email');
			$phpmailer->FromName   = cs_get_option('from_name');
		}

	}//end class
	if ( class_exists( 'Bytesed_Ajax_Request' ) ) {
		Bytesed_Ajax_Request::getInstance();
	}
}
