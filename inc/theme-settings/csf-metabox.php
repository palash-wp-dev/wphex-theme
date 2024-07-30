<?php
/*
 * Theme Metabox Options
 * @package Bytesed
 * @since 1.0.0
 * */

if ( !defined('ABSPATH') ){
	exit(); // exit if access directly
}

if ( class_exists('CSF') ){

	$allowed_html = Bytesed()->kses_allowed_html(array('mark'));

	$prefix = 'bytesed';
	/*-------------------------------------
		Post Format Options
	-------------------------------------*/
	CSF::createMetabox($prefix.'_post_video_options',array(
		'title' => esc_html__('Video Post Format Options','bytesed'),
		'post_type' => 'post',
		'post_formats' => 'video'
	));
	CSF::createSection($prefix.'_post_video_options',array(
		'fields' => array(
			array(
				'id' => 'video_url',
				'type' => 'text',
				'title' => esc_html__('Enter Video URL','bytesed'),
				'desc' => wp_kses(__('enter <mark>video url</mark> to show in frontend','bytesed'),$allowed_html)
			)
		)
	));
	CSF::createMetabox($prefix.'_post_gallery_options',array(
		'title' => esc_html__('Gallery Post Format Options','bytesed'),
		'post_type' => 'post',
		'post_formats' => 'gallery'
	));
	CSF::createSection($prefix.'_post_gallery_options',array(
		'fields' => array(
			array(
				'id' => 'gallery_images',
				'type' => 'gallery',
				'title' => esc_html__('Select Gallery Photos','bytesed'),
				'desc' => wp_kses(__('select <mark>gallery photos</mark> to show in frontend','bytesed'),$allowed_html)
			)
		)
	));
	/*-------------------------------------
	  Page Container Options
  -------------------------------------*/
	CSF::createMetabox($prefix.'_page_container_options',array(
		'title' => esc_html__('Page Options','bytesed'),
		'post_type' => array('page'),
	));
	CSF::createSection($prefix.'_page_container_options',array(
		'title' => esc_html__('Layout & Colors','bytesed'),
		'icon' => 'fa fa-columns',
		'fields' => Bytesed_Group_Fields::page_layout()
	));
	CSF::createSection($prefix.'_page_container_options',array(
		'title' => esc_html__('Header & Breadcrumb','bytesed'),
		'icon' => 'fa fa-header',
		'fields' => Bytesed_Group_Fields::Page_Container_Options('header_options')
	));
	CSF::createSection($prefix.'_page_container_options',array(
		'title' => esc_html__('Width & Padding','bytesed'),
		'icon' => 'fa fa-file-o',
		'fields' => Bytesed_Group_Fields::Page_Container_Options('container_options')
	));

	/*------------------------------------
		Download Metabox
	------------------------------------*/
	CSF::createMetabox($prefix.'_product_info',array(
		'title' => esc_html__('Product Information','bytesed'),
		'post_type' => 'download',
		'data_type' => 'unserialize'
	));
	CSF::createSection($prefix.'_product_info',array(
		'fields' => array(
			array(
				'id' => $prefix.'_thumbnail',
				'type' => 'media',
				'title' => esc_html__('Thumbnail','bytesed'),
			),
			array(
				'id' => $prefix.'_subtitle',
				'type' => 'text',
				'title' => esc_html__('Subtitle','bytesed'),
			),
			array(
				'id' => $prefix.'_cut_price',
				'type' => 'text',
				'title' => esc_html__('Cut Price','bytesed'),
			),
			array(
				'id' => $prefix.'_type',
				'type' => 'select',
				'options' => array(
					''  => esc_html__('Website','bytesed'),
					'envato' => esc_html__('Envato','bytesed')
				),
				'title' => esc_html__('Type','bytesed'),
				'default' => 'envato'
			),
			array(
				'id' => $prefix.'_extended_price',
				'type' => 'text',
				'title' => esc_html__('Extended Price','bytesed'),
			),
			array(
				'id' => $prefix.'_columns',
				'type' => 'text',
				'title' => esc_html__('Columns','bytesed'),
				'default' => esc_html__('4+','bytesed')
			),
			array(
				'id' => $prefix.'_compatible_browsers',
				'type' => 'textarea',
				'title' => esc_html__('Compatible Browsers','bytesed'),
			),
			array(
				'id' => $prefix.'_demo_url',
				'type' => 'text',
				'title' => esc_html__('Demo URL','bytesed'),
			),
			array(
				'id' => $prefix.'_item_url',
				'type' => 'text',
				'title' => esc_html__('Envato Item URL','bytesed'),
			),
			array(
				'id' => $prefix.'_high_resolution',
				'type' => 'switcher',
				'title' => esc_html__('High Resolution','bytesed'),
			),
			array(
				'id' => $prefix.'_layout',
				'type' => 'text',
				'title' => esc_html__('Layout','bytesed'),
			),
			array(
				'id' => $prefix.'_themeforest_files_included',
				'type' => 'textarea',
				'title' => esc_html__('ThemeForest Files Included','bytesed'),
			),
			array(
				'id' => $prefix.'_rating',
				'type' => 'text',
				'title' => esc_html__('Rating','bytesed'),
			),
			array(
				'id' => $prefix.'_rating_count',
				'type' => 'text',
				'title' => esc_html__('Rating Count','bytesed'),
			),
			array(
				'id' => $prefix.'_published_at',
				'type' => 'text',
				'title' => esc_html__('Created','bytesed'),
			),
			array(
				'id' => $prefix.'_updated_at',
				'type' => 'text',
				'title' => esc_html__('Last Update','bytesed'),
			),
			array(
				'id' => $prefix.'_compatible-software',
				'type' => 'text',
				'title' => esc_html__('Software Version','bytesed'),
			),
			array(
				'id' => $prefix.'_compatible-with',
				'type' => 'text',
				'title' => esc_html__('Compatible With','bytesed'),
			),
			array(
				'id' => $prefix.'_gutenberg-optimized',
				'type' => 'switcher',
				'title' => esc_html__('Gutenberg Optimized','bytesed'),
			),
			array(
				'id' => $prefix.'_source-files-included',
				'type' => 'textarea',
				'title' => esc_html__('Codecanyon Files Included','bytesed'),
			),
			array(
				'id' => $prefix.'_envato_product_id',
				'type' => 'text',
				'title' => esc_html__('Envato Product ID','bytesed'),
			),
			array(
				'id' => $prefix.'_framework',
				'type' => 'text',
				'title' => esc_html__('Framework','bytesed'),
			),
			array(
				'id' => $prefix.'_software_framework',
				'type' => 'text',
				'title' => esc_html__('Software Framework','bytesed'),
			),
			array(
				'id' => $prefix.'_widget_ready',
				'type' => 'text',
				'title' => esc_html__('Widget Ready','bytesed'),
			),array(
				'id' => $prefix.'_documentation',
				'type' => 'text',
				'title' => esc_html__('Documentation','bytesed'),
			),array(
				'id' => $prefix.'_graphics_files_included',
				'type' => 'text',
				'title' => esc_html__('Graphics Files Included','bytesed'),
			),
		)
	));
	/*-------------------------------------
	 Practice Area Options
  -------------------------------------*/
	CSF::createMetabox($prefix.'_practice_area_options',array(
		'title' => esc_html__('Practice Options','bytesed'),
		'post_type' => array('practice-area'),
		'priority'           => 'high',
	));
	CSF::createSection($prefix.'_practice_area_options',array(
		'fields' => array(
			array(
				'id' => 'icon',
				'type' => 'icon',
				'title' => esc_html__('Icon','bytesed'),
			)
		)
	));
	/*-------------------------------------
	 Attorney Options
  -------------------------------------*/
	CSF::createMetabox($prefix.'_attorney_options',array(
		'title' => esc_html__('Attorney Options','bytesed'),
		'post_type' => array('attorney'),
		'priority' => 'high'
	));
	CSF::createSection($prefix.'_attorney_options',array(
		'title' => esc_html__('Attorney Info','bytesed'),
		'id' => 'bytesed-info',
		'fields' => array(
			array(
				'id' => 'designation',
				'type' => 'text',
				'title' => esc_html__('Designation','bytesed'),
			),
			array(
				'id' => 'location',
				'type' => 'text',
				'title' => esc_html__('Location','bytesed'),
			),
			array(
				'id' => 'phone',
				'type' => 'text',
				'title' => esc_html__('Phone','bytesed'),
			),
			array(
				'id' => 'email',
				'type' => 'text',
				'title' => esc_html__('Email','bytesed'),
			),
			array(
				'id' => 'languages',
				'type' => 'text',
				'title' => esc_html__('Languages','bytesed'),
			),
		)
	));
	CSF::createSection($prefix.'_attorney_options',array(
		'title' => esc_html__('Social Info','bytesed'),
		'id' => 'social-info',
		'fields' => array(
			array(
				'id'     => 'social-icons',
				'type'   => 'repeater',
				'title'  => esc_html__('Social Info','bytesed'),
				'fields' => array(

					array(
						'id'    => 'title',
						'type'  => 'text',
						'title' => esc_html__('Title','bytesed')
					),
					array(
						'id'    => 'icon',
						'type'  => 'icon',
						'title' => esc_html__('Icon','bytesed')
					),
					array(
						'id'    => 'url',
						'type'  => 'text',
						'title' => esc_html__('URL','bytesed')
					),

				),
			),
		)
	));
	CSF::createSection($prefix.'_attorney_options',array(
		'title' => esc_html__('Contact Info','bytesed'),
		'id' => 'contact-info',
		'fields' => array(
			array(
				'id' => 'contact_shortcode',
				'type' => 'textarea',
				'title' => esc_html__('Contact Form Shortcode','bytesed'),
			),
		)
	));

}//endif