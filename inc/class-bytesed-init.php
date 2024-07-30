<?php
/**
 * @package Bytesed
 * @author Ir Tech
 */
if ( ! defined( "ABSPATH" ) ) {
	exit(); //exit if access directly
}

if ( ! class_exists( 'Bytesed_Init' ) ) {

	class Bytesed_Init {
		/*
		* $instance
		* @since 1.0.0
		* */
		protected static $instance;

		public function __construct() {
			/*
			 * theme setup
			 * */
			add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
			/**
			 * Widget Init
			 * */
			add_action( 'widgets_init', array( $this, 'theme_widgets_init' ) );
			/**
			 * Theme Assets
			 * */
			add_action( 'wp_enqueue_scripts', array( $this, 'theme_assets' ) );
// 			add_action( 'admin_init', array( $this, 'theme_assets_for_elementor' ) );
			/**
			 * Registers an editor stylesheet for the theme.
			 */
			add_action( 'admin_init', array( $this, 'add_editor_styles' ) );

            /**
             * Adds a class name to the wp_nav_menu() function default li item.
             */
            add_filter('nav_menu_css_class', array( $this, 'add_additional_class_on_li' ), 1, 3);
			
			add_action('customize_register', array( $this, 'add_field_for_white_logo' ) );
		}

        /**
         * Hooked function of 'add_additional_class_on_li' filter hook.
         */
        public function add_additional_class_on_li( $classes, $item, $args ) {
            if(isset($args->add_li_class)) {
                $classes[] = $args->add_li_class;
            }
            return $classes;
        }

		/**
		 * getInstance()
		 * */
		public static function getInstance() {
			if ( null == self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
		
		/**
         * Add extra field in the customize option to upload white logo
         * @since 1.0.0
         * */
        public function add_field_for_white_logo($wp_customize) {
            // Add a new setting for the additional image upload field
            $wp_customize->add_setting('white_logo', array(
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
            ));

            // Add a new control for the additional image upload field
            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'white_logo', array(
                'label' => __('Add White Logo', 'wphex'),
                'section' => 'title_tagline', // Add the control to the same section as the logo
                'settings' => 'white_logo',
            )));
        }

		/**
		 * Theme Setup
		 * @since 1.0.0
		 * */
		public function theme_setup() {
			/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on bytesed, use a find and replace
		 * to change 'bytesed' to the name of your theme in all the template files.
		 */
			load_theme_textdomain( 'bytesed', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support( 'post-thumbnails' );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'main-menu' => esc_html__( 'Primary Menu', 'bytesed' ),
				'secondary-menu' => esc_html__( 'Secondary Menu', 'bytesed' ),
				'third-menu' => esc_html__( 'Third Menu', 'bytesed' ),
				'footer-bottom-menu' => esc_html__( 'Footer Bottom', 'bytesed' ),
			) );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			// Set up the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'bytesed_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) ) );

			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			/**
			 * Add support for core custom logo.
			 *
			 * @link https://codex.wordpress.org/Theme_Logo
			 */
			add_theme_support( 'custom-logo', array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			) );
			//woocommerce support
			add_theme_support( 'woocommerce' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			//add theme support for post format
			add_theme_support( 'post-formats', array( 'image', 'video', 'gallery', 'link', 'quote' ) );
			// This variable is intended to be overruled from themes.
			// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
			// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
			$GLOBALS['content_width'] = apply_filters( 'bytesed_content_width', 740 );
			//add image sizes
			add_image_size( 'bytesed_classic', 750, 350, true );
			add_image_size( 'bytesed_medium', 550, 380, true );
			add_image_size( 'bytesed_grid', 370, 270, true );
			add_image_size( 'bytesed_product', 350, 200, false );

			self::load_theme_dependency_files();
		}

		/**
		 * Theme Widget Init
		 * @since 1.0.0
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 * */
		public function theme_widgets_init() {
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar', 'bytesed' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'bytesed' ),
				'before_widget' => '<div class="blog_details__sidebar__item">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="blog_details__sidebar__tableContent__title">',
				'after_title'   => '</h4>',
			) );
			register_sidebar( array(
				'name'          => esc_html__( 'Footer Widget Area', 'bytesed' ),
				'id'            => 'footer-widget',
				'description'   => esc_html__( 'Add widgets here.', 'bytesed' ),
				'before_widget' => '<div class="col-lg-3 col-md-6 col-sm-6"><div id="%1$s" class="wpHex_footer_widget widget">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h4 class="wphex_widget_title fw-500">',
				'after_title'   => '</h4>',
			) );

		}

		/**
		 * Theme Assets
		 * @since 1.0.0
		 * */
		public function theme_assets() {
			self::load_theme_css();
			self::load_theme_js();
		}

        // elementor support
        public function theme_assets_for_elementor() {
            self::load_elementor_support_js();
        }

		/*
	   * load theme options google fonts css
	   * @since 1.0.0
	   * */
		public static function load_google_fonts() {

			$enqueue_fonts = array();
			//body font enqueue
			$body_font           = cs_get_option( '_body_font' ) ? cs_get_option( '_body_font' ) : [];
			$body_font_variant   = cs_get_option( 'body_font_variant' ) ? cs_get_option( 'body_font_variant' ) : [];
			$body_font['family'] = ( isset( $body_font['font-family'] ) && ! empty( $body_font['font-family'] ) ) ? $body_font['font-family'] : 'Poppins';
			$body_font['font']   = ( isset( $body_font['type'] ) && ! empty( $body_font['type'] ) ) ? $body_font['type'] : 'google';
			$body_font_variant   = ! empty( $body_font_variant ) ? $body_font_variant : array( 400, 700, 600, 500 );
			$google_fonts        = array();

			if ( ! empty( $body_font_variant ) ) {
				foreach ( $body_font_variant as $variant ) {
					$google_fonts[] = array(
						'family'  => $body_font['family'],
						'variant' => $variant,
						'font'    => $body_font['font']
					);
				}
			}
			//heading font enqueue
			$heading_font_enable = false;
			if ( null == cs_get_option( 'heading_font_enable' ) ) {
				$heading_font_enable = false;
			} elseif ( '0' == cs_get_option( 'heading_font_enable' ) ) {
				$heading_font_enable = true;
			} elseif ( '1' == cs_get_option( 'heading_font_enable' ) ) {
				$heading_font_enable = false;
			}
			$heading_font           = cs_get_option( 'heading_font' ) ? cs_get_option( 'heading_font' ) : [];
			$heading_font_variant   = cs_get_option( 'heading_font_variant' ) ? cs_get_option( 'heading_font_variant' ) : [];
			$heading_font['family'] = ( isset( $heading_font['font-family'] ) && ! empty( $heading_font['font-family'] ) ) ? $heading_font['font-family'] : 'Source Serif Pro';
			$heading_font['font']   = ( isset( $heading_font['type'] ) && ! empty( $heading_font['type'] ) ) ? $heading_font['type'] : 'google';
			$heading_font_variant   = ! empty( $heading_font_variant ) ? $heading_font_variant : array(
				400,
				500,
				600,
				700,
				800
			);
			if ( ! empty( $heading_font_variant ) && ! $heading_font_enable ) {
				foreach ( $heading_font_variant as $variant ) {
					$google_fonts[] = array(
						'family'  => $heading_font['family'],
						'variant' => $variant,
						'font'    => $heading_font['font']
					);
				}
			}

			if ( ! empty( $google_fonts ) ) {
				foreach ( $google_fonts as $font ) {
					if ( ! empty( $font['font'] ) && $font['font'] == 'google' ) {
						$variant = ( ! empty( $font['variant'] ) && $font['variant'] !== 'regular' ) ? ':' . $font['variant'] : '';
						if ( ! empty( $font['family'] ) ) {
							$enqueue_fonts[] = $font['family'] . $variant;
						}
					}
				}
			}

			$enqueue_fonts = array_unique( $enqueue_fonts );

			return $enqueue_fonts;
		}

		/**
		 * Load Theme Css
		 * @since 1.0.0
		 * */
		public function load_theme_css() {
			$theme_version = BYTESED_DEV ? time() : Bytesed()->get_theme_info( 'version' );
			//load google fonts
			$enqueue_google_fonts = self::load_google_fonts();
			if ( ! empty( $enqueue_google_fonts ) ) {
				wp_enqueue_style( 'bytesed-google-fonts', esc_url( add_query_arg( 'family', urlencode( implode( '|', $enqueue_google_fonts ) ), '//fonts.googleapis.com/css' ) ), array(), null );
			}

			$all_css_files = array(
                array(
                    'handle' => 'bootstrap',
                    'src'    => BYTESED_CSS . '/bootstrap.min.css',
                    'deps'   => array(),
                    'ver'    => $theme_version,
                    'media'  => 'all',
                ),
				array(
					'handle' => 'all-plugin',
					'src'    => BYTESED_CSS . '/all_plugin.css',
					'deps'   => array(),
					'ver'    => $theme_version,
					'media'  => 'all',
				),

//				array(
//					'handle' => 'font-awesome',
//					'src'    => BYTESED_CSS . '/font-awesome.min.css',
//					'deps'   => array(),
//					'ver'    => $theme_version,
//					'media'  => 'all',
//				),
//				array(
//					'handle' => 'magnific-popup',
//					'src'    => BYTESED_CSS . '/magnific-popup.css',
//					'deps'   => array(),
//					'ver'    => $theme_version,
//					'media'  => 'all',
//				),
//				array(
//					'handle' => 'font-awesome-5',
//					'src'    =>  BYTESED_CSS . '/slick.css',
//					'deps'   => array(),
//					'ver'    => $theme_version,
//					'media'  => 'all',
//				),
				array(
					'handle' => 'default-style',
					'src'    => BYTESED_CSS . '/default-style.css',
					'deps'   => array(),
					'ver'    => $theme_version,
					'media'  => 'all',
				),
				array(
					'handle' => 'bytesed-main-style',
					'src'    => BYTESED_CSS . '/style.css',
					'deps'   => array(),
					'ver'    => $theme_version,
					'media'  => 'all',
				),
                array(
                    'handle' => 'animate',
                    'src'    => BYTESED_CSS . '/animate.css',
                    'deps'   => array(),
                    'ver'    => $theme_version,
                    'media'  => 'all',
                ),
                array(
                    'handle' => 'slick',
                    'src'    =>  BYTESED_CSS . '/slick.css',
                    'deps'   => array(),
                    'ver'    => $theme_version,
                    'media'  => 'all',
                ),
                array(
                    'handle' => 'line-awesome',
                    'src'    => BYTESED_CSS . '/line-awesome.min.css',
                    'deps'   => array(),
                    'ver'    => $theme_version,
                    'media'  => 'all',
                ),
                array(
                    'handle' => 'odometer',
                    'src'    => BYTESED_CSS . '/odometer.css',
                    'deps'   => array(),
                    'ver'    => $theme_version,
                    'media'  => 'all',
                ),
                array(
                    'handle' => 'wphex-style',
                    'src'    => BYTESED_CSS . '/wphex.css',
                    'deps'   => array(),
                    'ver'    => $theme_version,
                    'media'  => 'all',
                ),
			);

			$all_css_files = apply_filters( 'bytesed_theme_enqueue_style', $all_css_files );

			if ( is_array( $all_css_files ) && ! empty( $all_css_files ) ) {
				foreach ( $all_css_files as $css ) {
					call_user_func_array( 'wp_enqueue_style', $css );
				}
			}
			wp_enqueue_style( 'bytesed-style', get_stylesheet_uri() );

			if ( Bytesed()->is_bytesed_master_active() ) {
				if ( file_exists( BYTESED_DYNAMIC_STYLESHEETS . '/bytesed-inline-style.php' ) ) {
					require_once BYTESED_DYNAMIC_STYLESHEETS . '/bytesed-inline-style.php';
					wp_add_inline_style( 'bytesed-style', Bytesed()->minify_css_lines( $GLOBALS['bytesed_inline_css'] ) );
					wp_add_inline_style( 'bytesed-style', Bytesed()->minify_css_lines( $GLOBALS['theme_customize_css'] ) );
				}

			}
		}

		/**
		 * Load Theme js
		 * @since 1.0.0
		 * */
		public function load_theme_js() {
			$theme_version = BYTESED_DEV ? time() : Bytesed()->get_theme_info( 'version' );

			$all_js_files = array(
                array(
                    'handle'    => 'bootstrap-bundle',
                    'src'       => BYTESED_JS . '/bootstrap.bundle.min.js',
                    'deps'      => array( 'jquery' ),
                    'ver'       => $theme_version,
                    'args' => [
				         'in_footer' => true
				   ]
                ),
                array(
                    'handle'    => 'slick',
                    'src'       => BYTESED_JS . '/slick.js',
                    'deps'      => array( 'jquery' ),
                    'ver'       => $theme_version,
                    'args' => [
				         'in_footer' => true
				   ]
                ),
                //   array(
                //     'handle'    => 'viewport',
                //     'src'       => BYTESED_JS . '/viewport.jquery.js',
                //     'deps'      => array( 'jquery' ),
                //     'ver'       => $theme_version,
                //     'in_footer' => true,
                // ),
                array(
                    'handle'    => 'odometer',
                    'src'       => BYTESED_JS . '/odometer.js',
                    'deps'      => array( 'jquery' ),
                    'ver'       => $theme_version,
                    'args' => [
				         'in_footer' => true
				   ]
                ),
                array(
                    'handle'    => 'wow',
                    'src'       => BYTESED_JS . '/wow.js',
                    'deps'      => array( 'jquery' ),
                    'ver'       => $theme_version,
                    'args' => [
				         'in_footer' => true
				   ]
                ),
                array(
                    'handle'    => 'main-js',
                    'src'       => BYTESED_JS . '/main.js',
                    'deps'      => array( 'jquery' ),
                    'ver'       => $theme_version,
                    'args' => [
				         'in_footer' => true
				   ]
                ),
			);

			$all_js_files = apply_filters( 'bytesed_theme_enqueue_script', $all_js_files );

			if ( is_array( $all_js_files ) && ! empty( $all_js_files ) ) {
				foreach ( $all_js_files as $js ) {
					call_user_func_array( 'wp_enqueue_script', $js );
				}
			}
			wp_localize_script( 'bytesed-main-script', 'bytesed',
				array(
					'ajaxUrl' => admin_url( 'admin-ajax.php' ),
					'xgNonce' => wp_create_nonce(),
				) );
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

        // load elementor support js
        public function load_elementor_support_js() {
            $theme_version = BYTESED_DEV ? time() : Bytesed()->get_theme_info( 'version' );

            $all_js_files = array(
                array(
                    'handle'    => 'elementor-support',
                    'src'       => BYTESED_JS . '/elementor-support.js',
                    'deps'      => array( 'jquery'),
                    'ver'       => $theme_version,
                    'args' => [
				         'in_footer' => true
				   ]
                ),
            );

            $all_js_files = apply_filters( 'bytesed_theme_enqueue_script', $all_js_files );

            if ( is_array( $all_js_files ) && ! empty( $all_js_files ) ) {
                foreach ( $all_js_files as $js ) {
                    call_user_func_array( 'wp_enqueue_script', $js );
                }
            }
            wp_localize_script( 'bytesed-main-script', 'bytesed',
                array(
                    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                    'xgNonce' => wp_create_nonce(),
                ) );
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }
        }

		/**
		 * Load THeme Dependency Files
		 * @since 1.0.0
		 * */
		public function load_theme_dependency_files() {
			$includes_files = array(
				array(
					'file-name' => 'activation',
					'file-path' => BYTESED_TGMA
				),
				array(
					'file-name' => 'breadcrumb',
					'file-path' => BYTESED_INC
				),
				array(
					'file-name' => 'class-bytesed-excerpt',
					'file-path' => BYTESED_INC
				),
				array(
					'file-name' => 'class-bytesed-hook-customize',
					'file-path' => BYTESED_INC
				),
				array(
					'file-name' => 'comments-modifications',
					'file-path' => BYTESED_INC
				),
				array(
					'file-name' => 'customizer',
					'file-path' => BYTESED_INC
				),
				array(
					'file-name' => 'csf-group-fields',
					'file-path' => BYTESED_THEME_SETTINGS
				),
				array(
					'file-name' => 'csf-group-fields-value',
					'file-path' => BYTESED_THEME_SETTINGS
				),
				array(
					'file-name' => 'csf-metabox',
					'file-path' => BYTESED_THEME_SETTINGS
				),
				array(
					'file-name' => 'csf-shortcode-options',
					'file-path' => BYTESED_THEME_SETTINGS
				),
				array(
					'file-name' => 'csf-customizer',
					'file-path' => BYTESED_THEME_SETTINGS
				),
				array(
					'file-name' => 'csf-options',
					'file-path' => BYTESED_THEME_SETTINGS
				),
				array(
					'file-name' => 'class-ajax-request',
					'file-path' => BYTESED_INC
				),
			);

			if ( defined( 'BYTESED_MASTER_SELF_PATH' ) ) {
				$includes_files[] = array(
					'file-name' => 'bytesed-options-style',
					'file-path' => BYTESED_DYNAMIC_STYLESHEETS
				);
			}
			if ( class_exists( 'Easy_Digital_Downloads' ) ) {
				$includes_files[] = array(
					'file-name' => 'class-edd-customize',
					'file-path' => BYTESED_INC
				);
			}

			if ( is_array( $includes_files ) && ! empty( $includes_files ) ) {
				foreach ( $includes_files as $file ) {
					if ( file_exists( $file['file-path'] . '/' . $file['file-name'] . '.php' ) ) {
						require_once $file['file-path'] . '/' . $file['file-name'] . '.php';
					}
				}
			}

		}

		/**
		 * add editor style
		 * @since 1.0.0
		 * */
		public function add_editor_styles() {
			add_editor_style( get_template_directory_uri() . '/assets/css/editor-style.css' );
		}

	}//end class
	if ( class_exists( 'Bytesed_Init' ) ) {
		Bytesed_Init::getInstance();
	}
}
