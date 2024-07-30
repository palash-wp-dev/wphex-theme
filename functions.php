<?php
/**
 * bytesed functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bytesed
 */

/**
 * Define Bytesed Folder Path & Url Const
 * @since 1.0.0
 * */
define('BYTESED_THEME_ROOT',get_template_directory());
define('BYTESED_THEME_ROOT_URL',get_template_directory_uri());
define('BYTESED_INC',BYTESED_THEME_ROOT .'/inc');
define('BYTESED_THEME_SETTINGS',BYTESED_INC.'/theme-settings');
define('BYTESED_THEME_SETTINGS_IMAGES',BYTESED_THEME_ROOT_URL.'/inc/theme-settings/images');
define('BYTESED_TGMA',BYTESED_INC.'/plugins/tgma');
define('BYTESED_DYNAMIC_STYLESHEETS',BYTESED_INC.'/dynamic-stylesheets');
define('BYTESED_CSS',BYTESED_THEME_ROOT_URL.'/assets/css');
define('BYTESED_JS',BYTESED_THEME_ROOT_URL.'/assets/js');
define('BYTESED_ASSETS',BYTESED_THEME_ROOT_URL.'/assets');
define('BYTESED_DEV',true);
define('EDD_SLUG', 'our-products');
/**
 * Theme Initial File
 * @since 1.0.0
 * */
if (file_exists(BYTESED_INC .'/class-bytesed-init.php')){
	require_once BYTESED_INC .'/class-bytesed-init.php';
}
/**
 * Codester Framework Functions
 * @since 1.0.0
 * */
if (file_exists(BYTESED_INC .'/csf-functions.php')){
	require_once BYTESED_INC .'/csf-functions.php';
}
/**
 * theme helpers functions
 * @since 1.0.0
 * */
if (file_exists(BYTESED_INC .'/class-bytesed-helper-functions.php')){

	require_once BYTESED_INC .'/class-bytesed-helper-functions.php';
	if (!function_exists('Bytesed')){
		function Bytesed(){
			return class_exists('Bytesed_Helper_Functions') ? new Bytesed_Helper_Functions() : false;
		}
	}

}

add_action( 'template_redirect', 'bytesed_redirect_product_category_page') ;
function bytesed_redirect_product_category_page() {
	$slug     = defined( 'EDD_SLUG' ) ? EDD_SLUG : 'downloads';
	if (isset($_SERVER['HTTPS']) &&
	    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
	    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
	    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		$protocol = 'https://';
	}
	else {
		$protocol = 'http://';
	}

	$currenturl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$currenturl_relative = wp_make_link_relative($currenturl);
	$build_base_url = BYTESED_DEV ? '/xg' : '';
	switch ($currenturl_relative) {

        case $build_base_url . '/' . $slug . '/category/':
        case $build_base_url.'/'.$slug.'/category':
			$urlto = home_url('/'.$slug);

			break;

        default:
			return;

	}

	if ($currenturl != $urlto)
		exit( wp_redirect( $urlto ) );
}

remove_filter( 'the_content', 'wpautop' );
$br = false;
add_filter( 'the_content', function( $content ) use ( $br ) {
    return wpautop( $content, $br );
}, 10 );


function bytesed_defer_parsing_of_js( $url ) {
    if ( is_user_logged_in() ) return $url; //don't break WP Admin
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.js' ) ) return $url;
    return str_replace( ' src', ' defer src', $url );
}
add_filter( 'script_loader_tag', 'bytesed_defer_parsing_of_js', 10 );
