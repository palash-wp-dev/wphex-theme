<?php
/**
 * @package Bytesed
 * @author Ir-Tech
 */
if (!defined("ABSPATH")) {
	exit(); //exit if access directly
}

if (!class_exists('Bytesed_Helper_Functions')) {

	class Bytesed_Helper_Functions
	{
		/*
		* $instance
		* @since 1.0.0
		* */
		protected static $instance;

		public function __construct()
		{
		}

		/**
		 * getInstance()
		 * */
		public static function getInstance()
		{
			if (null == self::$instance) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Displays an optional post thumbnail.
		 *
		 * Wraps the post thumbnail in an anchor element on index views, or a div
		 * element when on single views.
		 */

		function post_thumbnail() {
			if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
				return;
			}

			if ( is_singular() ) :
				?>
            <div class="blog_details__single">
                <div class="blog_details__single__thumb wow zoomIn" data-wow-delay=".1s">
					<?php the_post_thumbnail( 'full' ); ?>
                </div><!-- .post-thumbnail -->
            </div>
			<?php else : ?>
                <div class="single_blog__thumb">
                    <a class="post-thumbnail " href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php
						the_post_thumbnail( 'bytesed_classic', array(
							'alt' => the_title_attribute( array(
								'echo' => false,
							) ),
						) );
						?>
                    </a>
                </div>
			<?php
			endif; // End is_singular().
		}

		/*
		 *  Frontend get post terms
		 *
		 * @since 1.0.0
		 * */
		public function get_terms_names($taxonomy_name = '', $output = '',$hide_empty = false){
			$return_val = [];
			$terms = get_terms(
				array(
					'taxonomy' => $taxonomy_name,
					'hide_empty' => $hide_empty
				)
			);
			foreach ( $terms as $term ){
				if ( 'id' == $output ){
					$return_val[$term->term_id] = $term->name;
				}else{
					$return_val[$term->slug] = $term->name;
				}
			}
			return $return_val;
		}

		/*
		 * sanitize_px
		 *
		 * @since 1.0.7
		 * */
		public function sanitize_px($value){
			$return_val = $value;
			if (filter_var($value,FILTER_VALIDATE_INT)){
				$return_val = $value .'px';
			}
			return $return_val;
		}

		/*
		 * minify_css_lines
		 *
		 * @since 1.0.7
		 * */
		public function minify_css_lines($css){
			// some of the following functions to minimize the css-output are directly taken
			// from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
			// all credits to Christian Schaefer: http://twitter.com/derSchepp
			// remove comments
			$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
			// backup values within single or double quotes
			preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
			for ($i=0; $i < count($hit[1]); $i++) {
				$css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
			}
			// remove traling semicolon of selector's last property
			$css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
			// remove any whitespace between semicolon and property-name
			$css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
			// remove any whitespace surrounding property-colon
			$css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
			// remove any whitespace surrounding selector-comma
			$css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
			// remove any whitespace surrounding opening parenthesis
			$css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
			// remove any whitespace between numbers and units
			$css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
			// shorten zero-values
			$css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
			// constrain multiple whitespaces
			$css = preg_replace('/\p{Zs}+/ims',' ', $css);
			// remove newlines
			$css = str_replace(array("\r\n", "\r", "\n"), '', $css);
			// Restore backupped values within single or double quotes
			for ($i=0; $i < count($hit[1]); $i++) {
				$css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
			}

			return $css;
		}

		/*
		 * check is cs framework activated
		 *
		 * @since 1.0.0
		 * */
		public function is_cs_framework_active(){
			return (defined('CS_VERSION')) ? true : false;
		}

		/*
		 * Pages Links
		 *
		 * @since 1.0.0
		 * */
		public function link_pages(){

			$defaults = array(
				'before' => '<div class="wp-link-pages"><span>'.esc_html__('Pages:' ,'bytesed').'</span>',
				'after' => '</div>',
				'link_before' => '',
				'link_after' => '',
				'next_or_number' => 'number',
				'separator' => ' ',
				'pagelink' => '%',
				'echo' => 1
			);
			wp_link_pages($defaults);
		}

		/*
		* Download Pagination
		*
		* @since 1.0.0
		* */
		public function download_pagination( $nav_query = NULL ){
			$big = 12345678;
			$page_format = paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?page=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $nav_query->max_num_pages,
				'type'  => 'array'
			) );
			if( is_array($page_format) ) {
				$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
				echo '<div class="blog-pagination margin-top-60"><ul>';
				echo '<li><span>'. esc_html($paged) . esc_html__(' of ','bytesed') . esc_html($nav_query->max_num_pages) .'</span></li>';
				foreach ( $page_format as $page ) {
					echo "<li>".wp_kses_post($page)."</li>";
				}
				echo '</ul></div>';
			}
		}

		/*
		 * Pagination
		 *
		 * @since 1.0.0
		 * */
		public function custom_post_pagination() {
            global $wp_query;
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $big = 12345678;

            $paginate = paginate_links(array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'total' => $wp_query->max_num_pages,
                'prev_next' => true,
                'type' => 'list',
                'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
                'next_text' => '<i class="fa-solid fa-angle-right"></i>',
                'current' => max(1, $paged),
            ));

            $paginate = str_replace( 'page-numbers', 'pagination_list', $paginate );
            $paginate = str_replace( '<a class="pagination_list"', '<a class="pagination_list__item__link"', $paginate );
            $paginate = str_replace( '</span>', '</a>', $paginate );
            $paginate = str_replace( '<li>', '<li class="pagination_list__item">', $paginate );
            $paginate = str_replace( '<li class="pagination_list__item"><a class="next pagination_list"', '<li class="pagination_list__item__prev"><a class="pagination_list__item__link"', $paginate );
            $paginate = str_replace( '<li class="pagination_list__item"><a class="prev pagination_list"', '<li class="pagination_list__item__prev"><a class="pagination_list__item__link"', $paginate );
            $paginate = str_replace( '<li class="pagination_list__item"><a class="next pagination_list"', '<li class="pagination_list__item__next"><a class="pagination_list__item__link"', $paginate );
            $paginate = str_replace( '<li class="pagination_list__item"><span aria-current="page" class="pagination_list current">', '<li class="pagination_list__item active"><a href="javascript:void(0)" class="pagination_list__item__link">', $paginate );
            $paginate = str_replace( '</span>', '</a>', $paginate );

            echo $paginate;
        }
        public function post_pagination( $nav_query = NULL ){
			global $wp_query;
			$big = 12345678;
			if(NULL == $nav_query){
				$page_format = paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages,
					'type'  => 'array'
				) );
				if( is_array($page_format) ) {
					$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
					echo '<div class="blog-pagination margin-top-60"><ul>';
					echo '<li><span>'. esc_html($paged) . esc_html__(' of ','bytesed') . esc_html($wp_query->max_num_pages) .'</span></li>';
					foreach ( $page_format as $page ) {
						echo "<li>".wp_kses_post($page)."</li>";
					}
					echo '</ul></div>';
				}
			}else{

				$page_format = paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $nav_query->max_num_pages,
					'type'  => 'array'
				) );

				if( is_array($page_format) ) {
					$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
					echo '<div class="blog-pagination margin-top-60"><ul>';
					echo '<li><span>'. esc_html($paged) . esc_html__(' of ','bytesed') . esc_html($nav_query->max_num_pages) .'</span></li>';
					foreach ( $page_format as $page ) {
						echo "<li>".wp_kses_post($page)."</li>";
					}
					echo '</ul></div>';
				}

			}
		}

		/**
		 * Prints HTML with meta information for the current post-date/time.
		 */
		public function posted_on() {

			$time_string = sprintf('<span class="entry-date published updated">%1$s</span>',esc_attr( get_the_date()));
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( DATE_W3C ) )
			);

			$posted_on = sprintf(
			/* translators: %s: post date. */
				esc_html_x( ' %s', 'post date', 'bytesed' ),
				'<a class="single_blog__tag__list__item" href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="fa fa-calendar" aria-hidden="true"></i> ' . $time_string . '</a>'
			);

			echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		}
		/**
		 * Prints HTML with meta information of posted by or authors.
		 */
		public function posted_by() {
			$byline = sprintf(
			/* translators: %s: post author. */
				esc_html_x( ' %s', 'post author', 'bytesed' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="fas fa-user" aria-hidden="true"></i> '. esc_html__('By ','bytesed'). esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		}
		/*
		* posted tags
		* @since 1.0.0
		* */
		public function posted_tag(){
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'bytesed' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<ul class="tags"><li class="title">' . esc_html__( 'Tags: ', 'bytesed' ) . '</li><li>' . ' %1$s'. '</li></ul>', $tags_list ); // WPCS: XSS OK.
			}
		}
		/**
		 * The post navigation
		 * @since 1.0.0
		 * */
		public function post_navigation(){
			the_post_navigation( array(
				'prev_text'                  => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;'.esc_html__( 'Prev Post','bytesed' ),
				'next_text'                  => esc_html__( 'Next Post','bytesed' ).'&nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
			) );
			echo wp_kses_post('<div class="clearfix"></div>');
		}

		/**
		 * is_home_page()
		 * */
		public static function is_home_page(){
			$check_home_page = true;
			if ( is_home() && is_front_page() ){
				$check_home_page = true;
			}elseif ( is_front_page() && !is_home()  ){
				$check_home_page = true;
			}elseif ( is_home() && !is_front_page() ){
				$check_home_page = false;
			}
			$return_val = $check_home_page;

			return $return_val;
		}

		/*
		 * get_teams_by_post_id()
		 * @since 1.0.0
		 * */
		public function get_terms_by_post_id($post_id,$taxonomy){
			$all_terms = array();
			$all_term_list =  get_the_terms($post_id,$taxonomy);

			foreach ($all_term_list as $term_item){
				$term_url = get_term_link($term_item->term_id,$taxonomy);
				$all_terms[$term_url] = $term_item->name;
			}
			return $all_terms;
		}
		/*
		 * kses allowed html
		 * @since 1.0.0
		 * */
		public function kses_allowed_html( $allowed_tags = 'all' ) {
			$allowed_html = array(
				'div'    => array( 'class' => array(), 'id' => array() ),
				'header' => array( 'class' => array(), 'id' => array() ),
				'h1'     => array( 'class' => array(), 'id' => array() ),
				'h2'     => array( 'class' => array(), 'id' => array() ),
				'h3'     => array( 'class' => array(), 'id' => array() ),
				'h4'     => array( 'class' => array(), 'id' => array() ),
				'h5'     => array( 'class' => array(), 'id' => array() ),
				'h6'     => array( 'class' => array(), 'id' => array() ),
				'p'      => array( 'class' => array(), 'id' => array() ),
				'span'   => array( 'class' => array(), 'id' => array() ),
				'i'      => array( 'class' => array(), 'id' => array() ),
				'mark'   => array( 'class' => array(), 'id' => array() ),
				'strong' => array( 'class' => array(), 'id' => array() ),
				'br'     => array( 'class' => array(), 'id' => array() ),
				'b'      => array( 'class' => array(), 'id' => array() ),
				'em'     => array( 'class' => array(), 'id' => array() ),
				'del'    => array( 'class' => array(), 'id' => array() ),
				'ins'    => array( 'class' => array(), 'id' => array() ),
				'u'      => array( 'class' => array(), 'id' => array() ),
				's'      => array( 'class' => array(), 'id' => array() ),
				'nav'    => array( 'class' => array(), 'id' => array() ),
				'ul'     => array( 'class' => array(), 'id' => array() ),
				'li'     => array( 'class' => array(), 'id' => array() ),
				'form'   => array( 'class' => array(), 'id' => array() ),
				'select' => array( 'class' => array(), 'id' => array() ),
				'option' => array( 'class' => array(), 'id' => array() ),
				'img'    => array( 'class' => array(), 'id' => array() ),
				'a'      => array( 'class' => array(), 'id' => array(), 'href' => array()),
			);

			if ( 'all' == $allowed_tags ) {
				return $allowed_html;
			} else {
				if ( is_array( $allowed_tags ) && ! empty( $allowed_tags ) ) {
					$specific_tags = array();
					foreach ( $allowed_tags as $allowed_tag ) {
						if ( array_key_exists( $allowed_tag, $allowed_html ) ) {
							$specific_tags[ $allowed_tag ] = $allowed_html[ $allowed_tag ];
						}
					}
					return $specific_tags;
				}
			}

		}
		/**
		 * get Theme global info
		 * @since 1.0.6
		 * */
		public static function get_theme_info($type = 'name'){

			$theme_information = array();
			if (is_child_theme()){
				$theme = wp_get_theme();
				$parent = $theme->get('Template');
				$theme_info = wp_get_theme($parent);
			}else{
				$theme_info = wp_get_theme();
			}
			$theme_information['THEME_NAME'] = $theme_info->get('Name');
			$theme_information['THEME_VERSION'] = $theme_info->get('Version');
			$theme_information['THEME_AUTHOR'] = $theme_info->get('Author');
			$theme_information['THEME_AUTHOR_URI'] = $theme_info->get('AuthorURI');

			switch ($type){
				case ("name"):
					$return_val = $theme_information['THEME_NAME'];
					break;
				case ("version"):
					$return_val = $theme_information['THEME_VERSION'];
					break;
				case ("author"):
					$return_val = $theme_information['THEME_AUTHOR'];
					break;
				case ("author_uri"):
					$return_val = $theme_information['THEME_AUTHOR_URI'];
					break;
				default:
					$return_val = $theme_information;
					break;
			}
			return $return_val;

		}
		/**
		 * get_page_id()
		 * @since 1.0.0
		 * */
		public function page_id(){
			global $post,$wp_query;
			$page_type_id = ( isset($post->ID) && in_array($post->ID, self::get_pages_id()) ) ? $post->ID : false;

			if ( false == $page_type_id ){
				$page_type_id = isset($wp_query->post->ID) ? $wp_query->post->ID : false;
			}
			$page_id = ( isset($page_type_id) ) ? $page_type_id : false;
			$page_id =  is_home() ? get_option('page_for_posts') : $page_id;

			return $page_id;
		}

		/**
		 * get_pages_id()
		 *@since 1.0.0
		 * */
		public function get_pages_id(){
			$pages_id = false;
			$pages = get_pages(array(
				'post_type' => 'page',
				'post_status' => 'publish'
			));

			if ( !empty($pages) && is_array($pages) ){
				$pages_id = array();
				foreach ( $pages as $page ){
					$pages_id[] = $page->ID;
				}
			}
			return $pages_id;
		}

		/**
		 * is bytesed active
		 * @sicne 1.0.0
		 * */
		public function is_bytesed_active(){
			$theme_name_array = array('Bytesed','Bytesed Child');
			$current_theme = wp_get_theme();
			$current_theme_name = $current_theme->get( 'Name' );
			return in_array($current_theme_name,$theme_name_array) ? true : false;
		}
		/**
		 * is bytesed master active
		 * @sicne 1.0.0
		 * */
		public function is_bytesed_master_active(){
			return defined('BYTESED_MASTER_SELF_PATH') ? true : false;
		}

		/**
		 * edd cart items
		 * @since 1.0.0
		 * */
		public function edd_cart_items(){
			$cart_contents = edd_get_cart_contents();
			if ( ! empty( $cart_contents ) ) :
				foreach ( $cart_contents as $key => $item ):
					?>
                    <li class="edd-cart-item">
                        <div class="thumb">
							<?php the_post_thumbnail('thumbnail'); ?>
                        </div>
                        <a class="header-cart-title" href="<?php echo esc_url(get_the_permalink($item['id']));?>"> <span class="edd-cart-item-title"><?php echo get_the_title($item['id']);?></span></a>
						<?php echo edd_item_quantities_enabled() ? '<span class="edd-cart-item-quantity">'. esc_html($item['quantity']).'&nbsp;@&nbsp;</span>' : ''; ?><span class="edd-cart-item-price"><?php echo esc_html($item['quantity']) .' X '. edd_currency_filter( edd_format_amount( edd_get_download_price( $item['id'] ) ) );?></span>
                        <a href="<?php echo esc_url(edd_remove_item_url( $key ))?>" data-nonce="<?php echo wp_create_nonce( 'edd-remove-cart-widget-item' ); ?>" data-cart-item="<?php echo esc_attr(absint( $key ));?>" data-download-id="<?php echo esc_attr(absint( $item['id'] ));?>" data-action="edd_remove_from_cart" class="edd-remove-from-cart"><i class="fa fa-times" ></i></a>
                    </li>
				<?php endforeach;
				edd_get_template_part( 'widget', 'cart-checkout' );
			else:
				edd_get_template_part( 'widget', 'cart-empty' );
			endif;
		}



	}//end class
	if (class_exists('Bytesed_Helper_Functions')){
		Bytesed_Helper_Functions::getInstance();
	}
}
