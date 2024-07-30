<?php
if (!defined('ABSPATH')){
	exit(); //exit if access it directly
}
/*
* Theme Excerpt Class
* @since 1.0.0
* @source https://gist.github.com/bgallagh3r/8546465
*/
if (!class_exists('Bytesed_excerpt')):
class Bytesed_excerpt {

    public static $length = 55;
    public static $types = array(
      'short' => 25,
      'regular' => 55,
      'long' => 100,
      'promo'=>15
    );

    public static $more = true;

    /**
    * Sets the length for the excerpt,
    * then it adds the WP filter
    * And automatically calls the_excerpt();
    *
    * @param string $new_length
    * @return void
    * @author Baylor Rae'
    */
    public static function length($new_length = 55, $more = true) {
        Bytesed_excerpt::$length = $new_length;
        Bytesed_excerpt::$more = $more;

        add_filter( 'excerpt_more', 'Bytesed_excerpt::auto_excerpt_more' );

        add_filter('excerpt_length', 'Bytesed_excerpt::new_length');

        Bytesed_excerpt::output();
    }

    public static function new_length() {
        if( isset(Bytesed_excerpt::$types[Bytesed_excerpt::$length]) )
            return Bytesed_excerpt::$types[Bytesed_excerpt::$length];
        else
            return Bytesed_excerpt::$length;
    }

    public static function output() {
        the_excerpt();
    }

    public static function continue_reading_link() {

        return '<span class="readmore"><a href="'.get_permalink().'">'.esc_html__('Read More','bytesed').'</a></span>';
    }

    public static function auto_excerpt_more( ) {
        if (Bytesed_excerpt::$more) :
            return ' ';
        else :
            return ' ';
        endif;
    }

} //end class
endif;

if (!function_exists('bytesed_excerpt')){

	function bytesed_excerpt($length = 55, $more=true) {
		Bytesed_excerpt::length($length, $more);
	}

}


?>