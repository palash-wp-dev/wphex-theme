<?php
/**
 * @package Bytesed
 * @author Ir Tech
 */
if (!defined("ABSPATH")) {
	exit(); //exit if access directly
}

if (!class_exists('Bytesed_Customize')) {

	class Bytesed_Customize
	{
		/*
		* $instance
		* @since 1.0.0
		* */
		protected static $instance;

		public function __construct()
		{
			//excerpt more
			add_action('excerpt_more',array($this,'excerpt_more'));
			//back top
			add_action('bytesed_after_body',array($this,'back_top'));
			//preloader
			add_action('bytesed_after_body',array($this,'preloader'));
			//breadcrumb
			add_action('bytesed_before_page_content',array($this,'breadcrumb'));
			//order comment form
            add_filter('comment_form_fields',array($this,'comment_fields_reorder'));
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
		 * Excerpt More
		 * @since 1.0.0
		 * */
		public function excerpt_more($more){
			$more = ' ';
			return $more;
		}
		/**
		 * Breadcrumb
		 * @since 1.0.0
		 * */
		public function breadcrumb(){
			$page_id = Bytesed()->page_id();
			$check_page = (!is_home() && !is_front_page() && is_singular() && !is_page('about-us') && !is_page('contact')) || is_search() || is_author() || is_404() || is_archive() ? true : false ;
			$check_home_page = Bytesed('Frontend')->is_home_page();
			$page_header_meta = Bytesed_Group_Fields_Value::page_container('bytesed','header_options');
			$header_variant_class = isset($page_header_meta['navbar_type']) ? 'navbar-'.$page_header_meta['navbar_type'] : 'navbar-default';
			$page_breadcrumb_enable = isset($page_header_meta['page_breadcrumb_enable']) && $page_header_meta['page_breadcrumb_enable'] ? $page_header_meta['page_breadcrumb_enable'] : false;
			$breadcrumb_enable = false;
			if (is_singular('download')){
				$header_variant_class .=' single-download-page ';
            }
			if ( !$check_home_page && !$check_page){
				$breadcrumb_enable = true;
			}elseif (!$page_breadcrumb_enable && $check_page){
				$breadcrumb_enable = true;
			}
			$breadcrumb_enable =  !cs_get_switcher_option('breadcrumb_enable') ? false : $breadcrumb_enable;

			if ( !$breadcrumb_enable ){
				return;
			}
			?>
            <div class="breadcrumb_area breadcrumb_area__padding section-bg-1">
			<div class="breadcrumb_shapes">
                    <div class="breadcrumb_shapes__item square_svg">
                        <svg width="48" height="45" viewBox="0 0 48 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 0C22 12.144 12.1702 22 0 22C12.1702 22 22 31.856 22 44C22 31.856 31.8298 22 44 22C31.8298 22 22 12.144 22 0ZM22 33.9093C19.6011 28.6293 15.3298 24.4053 10.0638 22C15.3298 19.5947 19.5426 15.312 22 10.0907C24.3989 15.3707 28.6702 19.5947 33.9362 22C28.6702 24.4053 24.3989 28.688 22 33.9093Z" stroke="#D0D0D0" stroke-width="2" />
                            <path d="M37 24C37 29.796 32.0851 34.5 26 34.5C32.0851 34.5 37 39.204 37 45C37 39.204 41.9149 34.5 48 34.5C41.9149 34.5 37 29.796 37 24ZM37 40.184C35.8005 37.664 33.6649 35.648 31.0319 34.5C33.6649 33.352 35.7713 31.308 37 28.816C38.1995 31.336 40.3351 33.352 42.9681 34.5C40.3351 35.648 38.1995 37.692 37 40.184Z" stroke="#D0D0D0" stroke-width="1" />
                        </svg>
                    </div>
                    <div class="breadcrumb_shapes__item wave_svg">
                        <svg width="50" height="39" viewBox="0 0 50 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.58927 32.6565C7.27227 26.4087 13.5699 15.9989 25.2964 24.3418C37.0229 32.6847 44.5793 21.7438 46.8917 15.2305" stroke="#D0D0D0" stroke-width="2" stroke-linecap="round"/>
                            <path d="M2.35685 23.7697C4.03985 17.522 10.3375 7.11219 22.064 15.4551C33.7905 23.798 41.3469 12.8571 43.6593 6.34379" stroke="#D0D0D0" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="breadcrumb_shapes__item triangle_svg">
                        <svg width="69" height="79" viewBox="0 0 69 79" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.5006 50.1185L22.3448 14.0588L53.1514 32.8197L21.5006 50.1185Z" stroke="#D0D0D0" stroke-width="3" stroke-linejoin="round"/>
                            <path d="M24.1127 65.5347L25.038 26.0118L58.8032 46.5745L24.1127 65.5347Z" stroke="#D0D0D0" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="breadcrumb_shapes__item circle_svg">
                        <svg width="59" height="70" viewBox="0 0 59 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="23.0491" cy="23.0491" r="21.5491" stroke="#D0D0D0" stroke-width="3"/>
                            <circle cx="35.7268" cy="46.0984" r="22.5491" stroke="#D0D0D0" stroke-width="1"/>
                        </svg>
                    </div>
                </div>	
            <div class="container">
                <div class="breadcrumb__contents center-text <?php echo esc_attr($header_variant_class);?>">
					<div class="row">
						<div class="col-lg-12">
							<div class="breadcrumb-inner">
								<?php
								if ( is_archive() ){
								    if (is_post_type_archive('download')){
									    print ('<div class="left-content-area">');
									    the_archive_title( '<h2 class="breadcrumb__title">', '</h2>' );
									    bytesed_breadcrumb();
									    print ('</div>');
									    ?>
									   	<!-- There was a search filed here -->
									    <?php
                                    }else{
								        the_archive_title( '<h2 class="breadcrumb__title">', '</h2>' );
								    }
								}elseif ( is_404() ){
									printf('<h2 class="breadcrumb__title">%1$s</h2>',esc_html__('Error 404','bytesed'));
								}elseif ( is_search() ){
									printf('<h2 class="breadcrumb__title">%1$s %2$s</h2>',esc_html__('Search Results for:','bytesed'),get_search_query());
								}elseif ( is_singular('post') ){
									printf('<h1 class="breadcrumb__title">%1$s </h1>',get_the_title());
								}elseif ( is_singular('page') ){
									if ( $page_header_meta['page_title']) {
										printf('<h2 class="breadcrumb__title">%1$s </h2>',get_the_title());
									}
								}elseif(is_singular('download')){
									bytesed_breadcrumb();
									printf('<h2 class="breadcrumb__title">%1$s </h2>',strip_tags(get_the_title()));

								}else{
									printf('<h2 class="breadcrumb__title">%1$s </h2>',get_the_title($page_id));
								}
								if ( $page_header_meta['page_breadcrumb'] && !is_singular('download') && !is_post_type_archive('download') ){
									bytesed_breadcrumb();
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
            </div>
			<?php
		}

		/**
		 * back top
		 * @since 1.0.0
		 * */
		public function back_top(){
			$back_top_enable = cs_get_switcher_option('back_top_enable');
			$back_top_icon = cs_get_option('back_top_icon') ? cs_get_option('back_top_icon') : 'fa fa-angle-up';
			if (!$back_top_enable){
				return;
			}
			?>
<!-- 			<div class="back-to-top">
				<span class="back-top"><i class="<?php echo esc_attr($back_top_icon);?>"></i></span>
			</div> -->
			<?php
		}
		/**
		 * Preloader
		 * @since 1.0.0
		 * */
		public function preloader(){
			$preloader_enable = cs_get_switcher_option('preloader_enable');
			if (!$preloader_enable){
				return;
			}
			?>

			<?php
		}

		/**
		 * @since 1.0.0
         * reorder comments form
		 * */
		public function comment_fields_reorder($fileds){
		    $comment_filed = $fileds['comment'];
		    unset($fileds['comment']);
		    $fileds['comment'] = $comment_filed;

			if (isset($fileds['cookies'])){
				$comment_cookies = $fileds['cookies'];
				unset($fileds['cookies']);
				$fileds['cookies'] = $comment_cookies;
			}

		    return $fileds;
        }


	}//end class
	if (class_exists('Bytesed_Customize')){
		Bytesed_Customize::getInstance();
	}
}
