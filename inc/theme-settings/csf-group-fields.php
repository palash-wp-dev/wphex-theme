<?php
/*
 * @package Bytesed
 * @since 1.0.0
 * */

if ( !defined('ABSPATH') ){
	exit(); // exit if access directly
}


if ( !class_exists('Bytesed_Group_Fields') ){

	class Bytesed_Group_Fields{
		/*
			* $instance
			* @since 1.0.0
			* */
		private static $instance;
		/*
		* construct()
		* @since 1.0.0
		* */
		public function __construct() {

		}
		/*
	   * getInstance()
	   * @since 1.0.0
	   * */
		public static function getInstance(){
			if ( null == self::$instance ){
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * page layout options
		 * @since 1.0.0
		 * */
		public static function page_layout(){
			$fields = array(
				array(
					'type'    => 'subheading',
					'content' => esc_html__('Page Layouts & Colors Options','bytesed'),
				),
				array(
					'id' => 'page_layout',
					'type' => 'image_select',
					'title' => esc_html__('Select Page Layout','bytesed'),
					'options' => array(
						'default' => BYTESED_THEME_SETTINGS_IMAGES .'/page/default.png',
						'left-sidebar' => BYTESED_THEME_SETTINGS_IMAGES .'/page/left-sidebar.png',
						'right-sidebar' => BYTESED_THEME_SETTINGS_IMAGES .'/page/right-sidebar.png',
						'blank' => BYTESED_THEME_SETTINGS_IMAGES .'/page/blank.png',
					),
					'default' => 'default'
				),
				array(
					'id' => 'page_bg_color',
					'type' => 'color',
					'title' => esc_html__('Page Background Color','bytesed'),
					'default' => '#ffffff'
				),
				array(
					'id' => 'page_content_bg_color',
					'type' => 'color',
					'title' => esc_html__('Page Content Background Color','bytesed'),
					'default' => '#ffffff'
				)
			);

			return $fields;
		}

		/**
		 * page container options
		 * @since 1.0.0
		 * */
		public static function  Page_Container_Options($type){
			$fields = array();
			$allowed_html = Bytesed()->kses_allowed_html(array('mark'));
			if ('header_options' == $type){
				$fields = array(
					array(
						'type'    => 'subheading',
						'content' => esc_html__('Page Header & Breadcrumb Options','bytesed'),
					),
					array(
						'id' => 'navbar_type',
						'title' => esc_html__('Navbar Type','bytesed'),
						'type' => 'image_select',
						'options' => array(
							'' => BYTESED_THEME_SETTINGS_IMAGES .'/header/01.png',
							'style-01' => BYTESED_THEME_SETTINGS_IMAGES .'/header/02.png',
						),
						'default' => '',
						'desc' => wp_kses(__('you can set <mark>navbar type</mark> transparent type or solid background.','bytesed'),$allowed_html),
					),
					array(
						'id' => 'page_title',
						'type' => 'switcher',
						'title' => esc_html__('Page Title','bytesed'),
						'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show/hide page title.','bytesed'),$allowed_html),
						'text_on' => esc_html__('Yes','bytesed'),
						'text_off' => esc_html__('No','bytesed'),
						'default' => true
					),
					array(
						'id' => 'page_breadcrumb',
						'type' => 'switcher',
						'title' => esc_html__('Page Breadcrumb','bytesed'),
						'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show/hide page breadcrumb.','bytesed'),$allowed_html),
						'text_on' => esc_html__('Yes','bytesed'),
						'text_off' => esc_html__('No','bytesed'),
						'default' => true
					),
				);
			}elseif ('container_options' == $type){
				$fields = array(
					array(
						'type'    => 'subheading',
						'content' => esc_html__('Page Width & Padding Options','bytesed'),
					),
					array(
						'id' => 'page_container',
						'type' => 'switcher',
						'title' => esc_html__('Page Full Width','bytesed'),
						'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to set page container full width.','bytesed'),$allowed_html),
						'text_on' => esc_html__('Yes','bytesed'),
						'text_off' => esc_html__('No','bytesed'),
						'default' => false
					),
					array(
						'type'    => 'subheading',
						'content' => esc_html__('Page Spacing Options','bytesed'),
					),
					array(
						'id' => 'page_spacing_top',
						'title' => esc_html__('Page Spacing Top','bytesed'),
						'type' => 'slider',
						'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page container.','bytesed'),$allowed_html),
						'min'     => 0,
						'max'     => 500,
						'step'    => 1,
						'unit'    => 'px',
						'default' => 120,
					),
					array(
						'id' => 'page_spacing_bottom',
						'title' => esc_html__('Page Spacing Bottom','bytesed'),
						'type' => 'slider',
						'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page container.','bytesed'),$allowed_html),
						'min'     => 0,
						'max'     => 500,
						'step'    => 1,
						'unit'    => 'px',
						'default' => 120,
					),
					array(
						'type'    => 'subheading',
						'content' => esc_html__('Page Content Spacing Options','bytesed'),
					),
					array(
						'id' => 'page_content_spacing',
						'type' => 'switcher',
						'title' => esc_html__('Page Content Spacing','bytesed'),
						'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to set page content spacing.','bytesed'),$allowed_html),
						'text_on' => esc_html__('Yes','bytesed'),
						'text_off' => esc_html__('No','bytesed'),
						'default' => false
					),
					array(
						'id' => 'page_content_spacing_top',
						'title' => esc_html__('Page Spacing Bottom','bytesed'),
						'type' => 'slider',
						'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page content area.','bytesed'),$allowed_html),
						'min'     => 0,
						'max'     => 500,
						'step'    => 1,
						'unit'    => 'px',
						'default' => 0,
						'dependency' => array('page_content_spacing' ,'==','true')
					),
					array(
						'id' => 'page_content_spacing_bottom',
						'title' => esc_html__('Page Spacing Bottom','bytesed'),
						'type' => 'slider',
						'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.','bytesed'),$allowed_html),
						'min'     => 0,
						'max'     => 500,
						'step'    => 1,
						'unit'    => 'px',
						'default' => 0,
						'dependency' => array('page_content_spacing' ,'==','true')
					),
					array(
						'id' => 'page_content_spacing_left',
						'title' => esc_html__('Page Spacing Left','bytesed'),
						'type' => 'slider',
						'desc' => wp_kses(__('you can set <mark>Padding Left</mark> for page content area.','bytesed'),$allowed_html),
						'min'     => 0,
						'max'     => 500,
						'step'    => 1,
						'unit'    => 'px',
						'default' => 0,
						'dependency' => array('page_content_spacing' ,'==','true')
					),
					array(
						'id' => 'page_content_spacing_right',
						'title' => esc_html__('Page Spacing Right','bytesed'),
						'type' => 'slider',
						'desc' => wp_kses(__('you can set <mark>Padding Right</mark> for page content area.','bytesed'),$allowed_html),
						'min'     => 0,
						'max'     => 500,
						'step'    => 1,
						'unit'    => 'px',
						'default' => 0,
						'dependency' => array('page_content_spacing' ,'==','true')
					),
				);
			}

			return $fields;
		}
		/**
		 * page layout options
		 * */
		public static function page_layout_options($title,$prefix){
			$allowed_html = Bytesed()->kses_allowed_html(array('mark'));
			$fields = array(
				array(
					'type' => 'subheading',
					'content' => '<h3>'.$title.esc_html__(' Page Options','bytesed').'</h3>',
				),
				array(
					'id' => $prefix.'_layout',
					'type' => 'image_select',
					'title' => esc_html__('Select Page Layout','bytesed'),
					'options' => array(
						'right-sidebar' => BYTESED_THEME_SETTINGS_IMAGES .'/page/right-sidebar.png',
						'left-sidebar' => BYTESED_THEME_SETTINGS_IMAGES .'/page/left-sidebar.png',
						'no-sidebar' => BYTESED_THEME_SETTINGS_IMAGES .'/page/no-sidebar.png',
					),
					'default' => 'right-sidebar'
				),
				array(
					'id' => $prefix.'_bg_color',
					'type' => 'color',
					'title' => esc_html__('Page Background Color','bytesed'),
					'default' => '#ffffff'
				),
				array(
					'id' => $prefix.'_spacing_top',
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
					'id' => $prefix.'_spacing_bottom',
					'title' => esc_html__('Page Spacing Bottom','bytesed'),
					'type' => 'slider',
					'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.','bytesed'),$allowed_html),
					'min'     => 0,
					'max'     => 500,
					'step'    => 1,
					'unit'    => 'px',
					'default' => 120,
				),
			);

			return $fields;
		}

		/**
		 * Post meta
		 * @since 1.0.0
		 * */
		public static function post_meta($prefix,$title){
			$allowed_html = Bytesed()->kses_allowed_html(array('mark'));
			$fields = array(
				array(
					'type' => 'subheading',
					'content' => '<h3>'.$title.esc_html__(' Post Options','bytesed').'</h3>',
				),
				array(
					'id' => $prefix.'_posted_by',
					'type' => 'switcher',
					'title' => esc_html__('Posted By','bytesed'),
					'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted by.','bytesed'),$allowed_html),
					'text_on' => esc_html__('Yes','bytesed'),
					'text_off' => esc_html__('No','bytesed'),
					'default' => true
				),
				array(
					'id' => $prefix.'_posted_on',
					'type' => 'switcher',
					'title' => esc_html__('Posted On','bytesed'),
					'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted on.','bytesed'),$allowed_html),
					'text_on' => esc_html__('Yes','bytesed'),
					'text_off' => esc_html__('No','bytesed'),
					'default' => true
				)
			);

			if ( 'blog_post' == $prefix){
				$fields[] = array(
					'id' => $prefix.'_posted_cat',
					'type' => 'switcher',
					'title' => esc_html__('Posted Category','bytesed'),
					'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted category.','bytesed'),$allowed_html),
					'text_on' => esc_html__('Yes','bytesed'),
					'text_off' => esc_html__('No','bytesed'),
					'default' => true
				);
				$fields[] =  array(
					'id' => $prefix.'_readmore_btn',
					'type' => 'switcher',
					'title' => esc_html__('Read More Button','bytesed'),
					'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide read more button.','bytesed'),$allowed_html),
					'text_on' => esc_html__('Yes','bytesed'),
					'text_off' => esc_html__('No','bytesed'),
					'default' => true
				);
				$fields[] =  array(
					'id' => $prefix.'_readmore_btn_text',
					'type' => 'text',
					'title' => esc_html__('Read More Text','bytesed'),
					'desc' => wp_kses(__('you can set read more <mark>button text</mark> to button text.','bytesed'),$allowed_html),
					'default' => esc_html__('Read More','bytesed'),
					'dependency' => array($prefix.'_readmore_btn' ,'==','true')
				);
				$fields[] =  array(
					'id' => $prefix.'_excerpt_more',
					'type' => 'text',
					'title' => esc_html__('Excerpt More','bytesed'),
					'desc' => wp_kses(__('you can set read more <mark>button text</mark> to button text.','bytesed'),$allowed_html),
					'attributes' => array(
						'placeholder' => esc_html__('....','bytesed')
					)
				);
				$fields[] =  array(
					'id' => $prefix.'_excerpt_length',
					'type' => 'select',
					'options' => array(
						'25' => esc_html__('Short','bytesed'),
						'55' => esc_html__('Regular','bytesed'),
						'100' => esc_html__('Long','bytesed'),
					),
					'title' => esc_html__('Excerpt Length','bytesed'),
					'desc' => wp_kses(__('you can set <mark> excerpt length</mark> for post.','bytesed'),$allowed_html),
				);
			}elseif('blog_single_post' == $prefix){

				$fields[] =array(
					'id' => $prefix.'_posted_category',
					'type' => 'switcher',
					'title' => esc_html__('Posted Category','bytesed'),
					'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted category.','bytesed'),$allowed_html),
					'text_on' => esc_html__('Yes','bytesed'),
					'text_off' => esc_html__('No','bytesed'),
					'default' => true
				);
				$fields[] =  array(
					'id' => $prefix.'_posted_tag',
					'type' => 'switcher',
					'title' => esc_html__('Posted Tags','bytesed'),
					'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post tags.','bytesed'),$allowed_html),
					'text_on' => esc_html__('Yes','bytesed'),
					'text_off' => esc_html__('No','bytesed'),
					'default' => true
				);
				$fields[] =  array(
					'id' => $prefix.'_posted_share',
					'type' => 'switcher',
					'title' => esc_html__('Post Share','bytesed'),
					'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post share.','bytesed'),$allowed_html),
					'text_on' => esc_html__('Yes','bytesed'),
					'text_off' => esc_html__('No','bytesed'),
					'default' => true
				);
			}

			return $fields;
		}

	}//end class

}//end if

