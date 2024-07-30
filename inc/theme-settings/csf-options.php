<?php
/**
 * Theme Options
 * @Packange Bytesed
 * @since 1.0.0
 */
if ( !defined('ABSPATH') ){
	exit(); // exit if access directly
}
// Control core classes for avoid errors
if( class_exists('CSF') ) {

	$allowed_html = Bytesed()->kses_allowed_html(array('mark'));
	$prefix = 'bytesed';
	// Create options
	CSF::createOptions( $prefix.'_theme_options', array(
		'menu_title' => esc_html__('Theme Options','bytesed'),
		'menu_slug'  => 'bytesed-theme-settings',
		'menu_parent'  => 'bytesed-theme-settings',
		'menu_type' => 'submenu',
		'footer_credit' => ' ',
		'menu_icon' => 'fa fa-filter',
		'show_footer' => false,
		'enqueue_webfont' => false,
		'show_search'        => false,
		'show_reset_all'     => true,
		'show_reset_section' => true,
		'show_all_options'   => false,
		'theme' => 'dark',
		'framework_title' =>  Bytesed()->get_theme_info('name').'<a href="'.Bytesed()->get_theme_info('author_uri').'" class="author_link">'.'<span>'.esc_html__('Author - ','bytesed').' </span>'.Bytesed()->get_theme_info('author').'</a>'
	) );

	/*-------------------------------------------------------
		** General  Options
	--------------------------------------------------------*/
	CSF::createSection( $prefix.'_theme_options', array(
		'title'  => esc_html__('General','bytesed'),
		'id' => 'general_options',
		'icon'  => 'fa fa-wrench',
		'fields' => array(
			array(
				'type' => 'subheading',
				'content' =>'<h3>'.esc_html__('Preloader Options','bytesed').'</h3>'
			),
			array(
				'id' => 'preloader_enable',
				'title' => esc_html__('Preloader','bytesed'),
				'type' => 'switcher',
				'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to enable/disable preloader','bytesed'),$allowed_html),
				'default' => true,
			),
			array(
				'id' => 'preloader_bg_color',
				'title' => esc_html__('Background Color','bytesed'),
				'type' => 'color',
				'default' => '#ffffff',
				'desc' => wp_kses(__('you can set <mark>overlay color</mark> for breadcrumb background image','bytesed'),$allowed_html),
				'dependency' => array('preloader_enable','==','true')
			),
			array(
				'type' => 'subheading',
				'content' =>'<h3>'.esc_html__('Back Top Options','bytesed').'</h3>'
			),
			array(
				'id' => 'back_top_enable',
				'title' => esc_html__('Back Top','bytesed'),
				'type' => 'switcher',
				'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide back to top','bytesed'),$allowed_html),
				'default' => true,
			),
			array(
				'id' => 'back_top_icon',
				'title' => esc_html__('Back Top Icon','bytesed'),
				'type' => 'icon',
				'default' => 'fa fa-angle-up',
				'desc' => wp_kses(__('you can set <mark>icon</mark> for back to top.','bytesed'),$allowed_html),
				'dependency' => array('back_top_enable','==','true')
			),
			array(
				'type' => 'subheading',
				'content' =>'<h3>'.esc_html__('Default Header Options','bytesed').'</h3>'
			),
			array(
				'id' => 'default_navbar_type',
				'title' => esc_html__('Default Navbar Type','bytesed'),
				'type' => 'image_select',
				'options' => array(
					'' => BYTESED_THEME_SETTINGS_IMAGES .'/header/01.png',
					'style-01' => BYTESED_THEME_SETTINGS_IMAGES .'/header/02.png',
				),
				'default' => '',
				'desc' => wp_kses(__('you can set <mark>navbar type</mark> transparent type or solid background.','bytesed'),$allowed_html),
			),
			array(
				'id' => 'default_footer_type',
				'title' => esc_html__('Default Footer Type','bytesed'),
				'type' => 'image_select',
				'options' => array(
					'' => BYTESED_THEME_SETTINGS_IMAGES .'/footer/01.png',
					'style-02' => BYTESED_THEME_SETTINGS_IMAGES .'/footer/02.png',
				),
				'default' => '',
				'desc' => wp_kses(__('you can set <mark>footer type</mark> transparent type or solid background.','bytesed'),$allowed_html),
			),
			
		)
	) );
	/*-------------------------------------------------------
		   ** Footer  Options
	--------------------------------------------------------*/
	CSF::createSection( $prefix.'_theme_options', array(
		'title'  => esc_html__('Breadcrumb','bytesed'),
		'id' => 'breadcrumb_options',
		'icon' => 'fas fa-list',
		'fields' => array(
			array(
				'type' => 'subheading',
				'content' =>'<h3>'.esc_html__('Breadcrumb Options','bytesed').'</h3>'
			),
			array(
				'id'                              => 'breadcrumb_background_image',
				'type'                            => 'background',
				'title'                           => 'Background',
				'background_gradient'             => true,
				'background_origin'               => true,
				'background_clip'                 => true,
				'background_blend_mode'           => true,
				'output' => '.breadcrumb-area',
				'output_important' => true,
			),
		)
	));
	/*-------------------------------------------------------
	   ** Entire Site Header  Options
   --------------------------------------------------------*/
	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'headers_settings',
		'title' => esc_html__('Headers Settings','bytesed'),
		'icon' => 'fa fa-header'
	));
	/* Header Style 01 */
	CSF::createSection( $prefix.'_theme_options', array(
		'title'  => esc_html__('Header One','bytesed'),
		'id' => 'theme_header_one_options',
		'icon' => 'fa fa-image',
		'parent' => 'headers_settings',
		'fields' => array(
			array(
				'type' => 'subheading',
				'content' =>'<h3>'.esc_html__('Logo Options','bytesed').'</h3>'
			),
			array(
				'id'      => 'header_one_logo',
				'type'    => 'media',
				'title'   => esc_html__('Logo','bytesed'),
				'library' => 'image',
				'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo','bytesed'),$allowed_html),
			)
		)
	));
	/* Header Style 02 */
	CSF::createSection( $prefix.'_theme_options', array(
		'title'  => esc_html__('Header Two','bytesed'),
		'id' => 'theme_header_two_options',
		'icon' => 'fa fa-image',
		'parent' => 'headers_settings',
		'fields' => array(
			array(
				'type' => 'subheading',
				'content' =>'<h3>'.esc_html__('Logo Options','bytesed').'</h3>'
			),
			array(
				'id'      => 'header_two_logo',
				'type'    => 'media',
				'title'   => esc_html__('Logo','bytesed'),
				'library' => 'image',
				'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo','bytesed'),$allowed_html),
			),
			
			array(
				'type' => 'subheading',
				'content' =>'<h3>'.esc_html__('Top Bar Options','bytesed').'</h3>'
			),
			array(
				'id'     => 'top_bar_info_item',
				'type'   => 'repeater',
				'title'  => esc_html__('Top Bar Info Items','bytesed'),
				'fields' => array(

					array(
						'id'    => 'text',
						'type'  => 'text',
						'title' => esc_html__('Text','bytesed')
					),
					array(
						'id'    => 'icon',
						'type'  => 'icon',
						'title' => esc_html__('Icon','bytesed')
					),
					array(
						'id'    => 'link',
						'type'  => 'text',
						'title' => esc_html__('URL','bytesed')
					),

				),
			),
			array(
				'id'     => 'top_bar_social_item',
				'type'   => 'repeater',
				'title'  => esc_html__('Top Bar Social Items','bytesed'),
				'fields' => array(
					array(
						'id'    => 'icon',
						'type'  => 'icon',
						'title' => esc_html__('Icon','bytesed')
					),
					array(
						'id'    => 'link',
						'type'  => 'text',
						'title' => esc_html__('URL','bytesed')
					),

				),
			),

		)
	));
	
	/*-------------------------------------------------------
		   ** Footer  Options
	--------------------------------------------------------*/
	CSF::createSection( $prefix.'_theme_options', array(
		'title'  => esc_html__('Footer','bytesed'),
		'id' => 'footer_options',
		'icon' => 'fa fa-copyright',
		'fields' => array(
			array(
				'type' => 'subheading',
				'content' =>'<h3>'.esc_html__('Footer Options','bytesed').'</h3>'
			),
			array(
				'id'      => 'footer_two_logo',
				'type'    => 'media',
				'title'   => esc_html__('Logo','bytesed'),
				'library' => 'image',
				'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo','bytesed'),$allowed_html),
			),
			array(
				'id'    => 'footer_two_description',
				'type'  => 'textarea',
				'title' => esc_html__('Footer Two Description','bytesed')
			),
			array(
				'id'    => 'footer_two_subscriber',
				'type'  => 'textarea',
				'title' => esc_html__('Footer Two Subscriber Shortcode','bytesed')
			),

			array(
				'id' => 'footer_spacing',
				'title' => esc_html__('Footer Spacing','bytesed'),
				'type' => 'switcher',
				'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to set footer spacing','bytesed'),$allowed_html),
				'default' => true,
			),
			array(
				'id' => 'footer_top_spacing',
				'title' => esc_html__('Footer Top Spacing','bytesed'),
				'type' => 'slider',
				'desc' => wp_kses(__('you can set <mark>padding</mark> for footer top','bytesed'),$allowed_html),
				'min' => 0,
				'max' => 500,
				'step' => 1,
				'unit' => 'px',
				'default' => 100,
				'dependency' => array('footer_spacing' ,'==','true')
			),
			array(
				'id' => 'footer_bottom_spacing',
				'title' => esc_html__('Footer Bottom Spacing','bytesed'),
				'type' => 'slider',
				'desc' => wp_kses(__('you can set <mark>padding</mark> for footer bottom','bytesed'),$allowed_html),
				'min' => 0,
				'max' => 500,
				'step' => 1,
				'unit' => 'px',
				'default' => 65,
				'dependency' => array('footer_spacing' ,'==','true')
			),
			array(
				'type' => 'subheading',
				'content' =>'<h3>'.esc_html__('Footer Copyright Area Options','bytesed').'</h3>'
			),
			array(
				'id' => 'copyright_area_spacing',
				'title' => esc_html__('Copyright Area Spacing','bytesed'),
				'type' => 'switcher',
				'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to set copyright area spacing','bytesed'),$allowed_html),
				'default' => true,
			),
			array(
				'id' => 'copyright_text',
				'title' => esc_html__('Copyright Area Text','bytesed'),
				'type' => 'text',
				'desc' => wp_kses(__('use  <mark>{copy}</mark> for copyright symbol, use <mark>{year}</mark> for current year, ','bytesed'),$allowed_html)
			),
			array(
				'id' => 'copyright_area_top_spacing',
				'title' => esc_html__('Copyright Area Top Spacing','bytesed'),
				'type' => 'slider',
				'desc' => wp_kses(__('you can set <mark>padding</mark> for copyright area top','bytesed'),$allowed_html),
				'min' => 0,
				'max' => 500,
				'step' => 1,
				'unit' => 'px',
				'default' => 20,
				'dependency' => array('copyright_area_spacing' ,'==','true')
			),
			array(
				'id' => 'copyright_area_bottom_spacing',
				'title' => esc_html__('Copyright Area Bottom Spacing','bytesed'),
				'type' => 'slider',
				'desc' => wp_kses(__('you can set <mark>padding</mark> for copyright area bottom','bytesed'),$allowed_html),
				'min' => 0,
				'max' => 500,
				'step' => 1,
				'unit' => 'px',
				'default' => 20,
				'dependency' => array('copyright_area_spacing' ,'==','true')
			),
		)
	));
	/*-------------------------------------------------------
		  ** Blog  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'blog_settings',
		'title' => esc_html__('Blog Settings','bytesed'),
		'icon' => 'fa fa-rss'
	));
	CSF::createSection($prefix.'_theme_options',array(
		'parent' => 'blog_settings',
		'id' => 'blog_post_options',
		'title' => esc_html__('Blog Post','bytesed'),
		'icon' => 'fa fa-list-ul',
		'fields' => Bytesed_Group_Fields::post_meta('blog_post',esc_html__('Blog Page','bytesed'))
	));
	CSF::createSection($prefix.'_theme_options',array(
		'parent' => 'blog_settings',
		'id' => 'blog_single_post_options',
		'title' => esc_html__('Single Post','bytesed'),
		'icon' => 'fa fa-list-alt',
		'fields' => Bytesed_Group_Fields::post_meta('blog_single_post',esc_html__('Blog Single Page','bytesed'))
	));
	/*-------------------------------------------------------
		  ** Pages & templates  Options
   --------------------------------------------------------*/
	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'pages_and_template',
		'title' => esc_html__('Pages Settings','bytesed'),
		'icon' => 'fa fa-files-o'
	));
	/*  404 page options */
	CSF::createSection($prefix.'_theme_options',array(
		'id' => '404_page',
		'title' => esc_html__('404 Page','bytesed'),
		'parent' => 'pages_and_template',
		'icon' => 'fa fa-exclamation-triangle',
		'fields' => array(
			array(
				'type' => 'subheading',
				'content' => '<h3>'.esc_html__('404 Page Options','bytesed').'</h3>',
			),
			array(
				'id' => '404_bg_color',
				'type' => 'color',
				'title' => esc_html__('Page Background Color','bytesed'),
				'default' => '#ffffff'
			),
			array(
				'id' =>'404_title',
				'title' => esc_html__('Title','bytesed'),
				'type' => 'text',
				'info' => wp_kses(__('you can change <mark>title</mark> of 404 page' ,'bytesed'),$allowed_html),
				'attributes' => array('placeholder'=>esc_html__('404','bytesed'))
			),
			array(
				'id' => '404_subtitle',
				'title' => esc_html__('Sub Title','bytesed'),
				'type' => 'text',
				'info' => wp_kses(__('you can change <mark>sub title</mark> of 404 page' ,'bytesed'),$allowed_html),
				'attributes' => array('placeholder'=>esc_html__('Oops! That page can’t be found.','bytesed'))
			),
			array(
				'id' => '404_paragraph',
				'title' => esc_html__('Paragraph','bytesed'),
				'type' => 'textarea',
				'info' => wp_kses(__('you can change <mark>paragraph</mark> of 404 page' ,'bytesed'),$allowed_html),
				'attributes' => array('placeholder'=>esc_html__('It looks like nothing was found at this location. Maybe try one of the links below or a search?','bytesed'))
			),
			array(
				'id' => '404_button_text',
				'title' => esc_html__('Button Text','bytesed'),
				'type' => 'text',
				'info' => wp_kses(__('you can change <mark>button text</mark> of 404 page' ,'bytesed'),$allowed_html),
				'attributes' => array('placeholder'=>esc_html__('back to home','bytesed'))
			),
			array(
				'id' => '404_spacing_top',
				'title' => esc_html__('Page Spacing Top','bytesed'),
				'type' => 'slider',
				'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page content area.','bytesed'),$allowed_html),
				'min'     => 0,
				'max'     => 500,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 120,
			),
			array(
				'id' => '404_spacing_bottom',
				'title' => esc_html__('Page Spacing Bottom','bytesed'),
				'type' => 'slider',
				'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.','bytesed'),$allowed_html),
				'min'     => 0,
				'max'     => 500,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 120,
			),
		)
	));
	/*  blog page options */
	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'blog_page',
		'title' => esc_html__('Blog Page','bytesed'),
		'parent' => 'pages_and_template',
		'icon' => 'fa fa-indent',
		'fields' => Bytesed_Group_Fields::page_layout_options(esc_html__('Blog','bytesed'),'blog')
	));
	/*  blog single page options */
	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'blog_single_page',
		'title' => esc_html__('Blog Single Page','bytesed'),
		'parent' => 'pages_and_template',
		'icon' => 'fa fa-indent',
		'fields' => Bytesed_Group_Fields::page_layout_options(esc_html__('Blog Single','bytesed'),'blog_single')
	));
	/*  archive page options */
	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'archive_page',
		'title' => esc_html__('Archive Page','bytesed'),
		'parent' => 'pages_and_template',
		'icon' => 'fa fa-archive',
		'fields' => Bytesed_Group_Fields::page_layout_options(esc_html__('Archive','bytesed'),'archive')
	));
	/*  search page options */
	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'search_page',
		'title' => esc_html__('Search Page','bytesed'),
		'parent' => 'pages_and_template',
		'icon' => 'fa fa-search',
		'fields' => Bytesed_Group_Fields::page_layout_options(esc_html__('Search','bytesed'),'search')
	));
	/*  download archive options */
	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'download_archive_page',
		'title' => esc_html__('Download Archive Page','bytesed'),
		'parent' => 'pages_and_template',
		'icon' => 'fa fa-check-square-o',
		'fields' => array(
			array(
				'type' => 'subheading',
				'content' => '<h3>'.esc_html__('Download Archive Page Page Options','bytesed').'</h3>',
			),
			array(
				'id' => 'download_archive_item',
				'type' => 'text',
				'title' => esc_html__('Archive Page Items','bytesed'),
				'default' => '9'
			),
			array(
				'id' => 'download_archive_bg_color',
				'type' => 'color',
				'title' => esc_html__('Page Background Color','bytesed'),
				'default' => '#ffffff'
			),
			array(
				'id' => 'download_archive_spacing_top',
				'title' => esc_html__('Page Spacing Top','bytesed'),
				'type' => 'slider',
				'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page content area.','bytesed'),$allowed_html),
				'min'     => 0,
				'max'     => 500,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 120,
			),
			array(
				'id' => 'download_archive_spacing_bottom',
				'title' => esc_html__('Page Spacing Bottom','bytesed'),
				'type' => 'slider',
				'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.','bytesed'),$allowed_html),
				'min'     => 0,
				'max'     => 500,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 120,
			)
		)
	));


	/*-------------------------------------------------------
		   ** Typography  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'typography',
		'title' => esc_html__('Typography','bytesed'),
		'icon' => 'fa fa-text-width',
		'fields' => array(
			array(
				'type' => 'subheading',
				'content' => '<h3>'.esc_html__('Body Font Options','bytesed').'</h3>',
			),
			array(
				'type' => 'typography',
				'title' => esc_html__('Typography','bytesed'),
				'id' => '_body_font',
				'default' => array(
					'font-family' => 'Poppins',
					'font-size'   => '16',
					'line-height' => '26',
					'unit'        => 'px',
					'type'        => 'google',
				),
				'color' => false,
				'subset' => false,
				'text_align' => false,
				'text_transform' => false,
				'letter_spacing' => false,
				'desc' => wp_kses(__('you can set <mark>font</mark> for all html tags (if not use different heading font)','bytesed'),$allowed_html),
			),
			array(
				'id'          => 'body_font_variant',
				'type'        => 'select',
				'title'       => esc_html__('Load Font Variant','bytesed'),
				'multiple'    => true,
				'chosen'      => true,
				'options' => array(
					'300' => esc_html__('Light 300','bytesed'),
					'400' => esc_html__('Regular 400','bytesed'),
					'500' => esc_html__('Medium 500','bytesed'),
					'600' => esc_html__('Semi Bold 600','bytesed'),
					'700' => esc_html__('Bold 700','bytesed'),
					'800' => esc_html__('Extra Bold 800','bytesed'),
				),
				'default'     => array('400','700','600')
			),
			array(
				'type' => 'subheading',
				'content' => '<h3>'.esc_html__('Heading Font Options','bytesed').'</h3>',
			),
			array(
				'type' => 'switcher',
				'id' => 'heading_font_enable',
				'title' => esc_html__('Heading Font','bytesed'),
				'desc' => wp_kses(__('you can set <mark>yes</mark> to select different heading font','bytesed'),$allowed_html),
				'default' => false
			),
			array(
				'type' => 'typography',
				'title' => esc_html__('Typography','bytesed'),
				'id' => 'heading_font',
				'default' => array(
					'font-family' => 'Poppins',
					'type'        => 'google',
				),
				'color' => false,
				'subset' => false,
				'text_align' => false,
				'text_transform' => false,
				'letter_spacing' => false,
				'font_size' => false,
				'line_height' => false,
				'desc' => wp_kses(__('you can set <mark>font</mark> for  for heading tag .eg: h1,h2mh3,h4,h5,h6','bytesed'),$allowed_html),
				'dependency' => array('heading_font_enable' ,'==','true')
			),
			array(
				'id'          => 'heading_font_variant',
				'type'        => 'select',
				'title'       => esc_html__('Load Font Variant','bytesed'),
				'multiple'    => true,
				'chosen'      => true,
				'options' => array(
					'300' => esc_html__('Light 300','bytesed'),
					'400' => esc_html__('Regular 400','bytesed'),
					'500' => esc_html__('Medium 500','bytesed'),
					'600' => esc_html__('Semi Bold 600','bytesed'),
					'700' => esc_html__('Bold 700','bytesed'),
					'800' => esc_html__('Extra Bold 800','bytesed'),
				),
				'default'     => array('400','500','600','700'),
				'dependency' => array('heading_font_enable' ,'==','true')
			),
		)
	));
	/*--------------------------------------------------------------
			Envato Api Option
		----------------------------------------------------------------*/

	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'envato_api_page',
		'title' => esc_html__('Envato API','bytesed'),
		'icon' => 'fa fa-indent',
		'fields' => array(
			array(
				'type' => 'subheading',
				'content' => '<h3>'.esc_html__('Envato API Settings','bytesed').'</h3>',
			),
			array(
				'type' => 'text',
				'id' => 'envato_api_token',
				'title' => esc_html__('API Token','bytesed'),
				'desc' => wp_kses(__('enter your <mark>API Token</mark> of envato api token app','bytesed'),$allowed_html),
			),
		)
	));
	/*--------------------------------------------------------------
		Envato Api Option
	----------------------------------------------------------------*/

	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'smtp_mail_setup',
		'title' => esc_html__('SMTP Setup','bytesed'),
		'icon' => 'fa fa-envelope',
		'fields' => array(
			array(
				'type' => 'subheading',
				'content' => '<h3>'.esc_html__('SMTP Settings','bytesed').'</h3>',
			),
			array(
				'type' => 'text',
				'id' => 'smtp_host',
				'title' => esc_html__('SMTP HOST','bytesed'),
				'desc' => wp_kses(__('enter your <mark>HOST</mark> name of smtp','bytesed'),$allowed_html),
			),
			array(
				'type' => 'text',
				'id' => 'smtp_port',
				'title' => esc_html__('SMTP PORT','bytesed'),
				'desc' => wp_kses(__('enter your <mark>PORT</mark> of smtp','bytesed'),$allowed_html),
			),
			array(
				'type' => 'text',
				'id' => 'smtp_username',
				'title' => esc_html__('SMTP USERNAME','bytesed'),
				'desc' => wp_kses(__('enter your <mark>USERNAME</mark> of smtp','bytesed'),$allowed_html),
			),
			array(
				'type' => 'text',
				'id' => 'smtp_password',
				'title' => esc_html__('SMTP PASSWORD','bytesed'),
				'desc' => wp_kses(__('enter your <mark>PASSWORD</mark> of smtp','bytesed'),$allowed_html),
			),
			array(
				'type' => 'text',
				'id' => 'smtp_enc',
				'title' => esc_html__('SMTP ENCRYPTION','bytesed'),
				'desc' => wp_kses(__('enter your <mark>ENCRYPTION</mark> of smtp','bytesed'),$allowed_html),
			),
			array(
				'type' => 'subheading',
				'content' => '<h3>'.esc_html__('Mail Settings','bytesed').'</h3>',
			),
			array(
				'type' => 'text',
				'id' => 'from_email',
				'title' => esc_html__('From Email','bytesed'),
				'desc' => wp_kses(__('enter your <mark>from</mark> mail','bytesed'),$allowed_html),
			),
			array(
				'type' => 'text',
				'id' => 'from_name',
				'title' => esc_html__('From Name','bytesed'),
				'desc' => wp_kses(__('enter your <mark>From</mark> name','bytesed'),$allowed_html),
			),
		)
	));
	/*-------------------------------------------------------
		   ** Backup  Options
	--------------------------------------------------------*/
	CSF::createSection($prefix.'_theme_options',array(
		'id' => 'backup',
		'title' => esc_html__('Import / Export','bytesed'),
		'icon' => 'fa fa-upload',
		'fields' => array(
			array(
				'type' => 'notice',
				'style' => 'warning',
				'content' => esc_html__('You can save your current options. Download a Backup and Import.','bytesed'),
			),
			array(
				'type' => 'backup',
				'title' => esc_html__('Backup & Import','bytesed')
			)
		)
	));


}
