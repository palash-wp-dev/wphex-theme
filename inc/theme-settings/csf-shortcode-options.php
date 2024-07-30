<?php
/**
 * theme shortcode generator
 * @since 1.0.0
 * */
if (!defined('ABSPATH')){
	exit(); //exit if access it directly
}

// Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {
	$prefix = 'bytesed';
	CSF::createShortcoder( $prefix.'_shortcodes', array(
		'button_title'   => esc_html__('Add Shortcode','bytesed'),
		'select_title'   => esc_html__('Select a shortcode','bytesed'),
		'insert_title'   => esc_html__('Insert Shortcode','bytesed')
	) );

	/*------------------------------------
		Inline info link options
	-------------------------------------*/
	CSF::createSection( $prefix.'_shortcodes', array(
		'title'     => esc_html__('Inline Info Link','bytesed'),
		'view'      => 'group',
		'shortcode' => 'bytesed_info_item_wrap',
		'group_shortcode' => 'bytesed_info_link',
		'group_fields'    => array(
			array(
				'id'    => 'icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon','bytesed'),
			),
			array(
				'id'      => 'text',
				'type'    => 'text',
				'title'   => esc_html__('Text','bytesed'),
			),
			array(
				'id'      => 'url',
				'type'    => 'text',
				'title'   => esc_html__('URL','bytesed'),
			)
		)
	) );
	/*------------------------------------
		info item two
	-------------------------------------*/
	CSF::createSection( $prefix.'_shortcodes', array(
		'title'     => esc_html__('Info Item Two','bytesed'),
		'view'      => 'group',
		'shortcode' => 'bytesed_info_item_two_wrap',
		'group_shortcode' => 'bytesed_info_item_two',
		'group_fields'    => array(
			array(
				'id'    => 'icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon','bytesed'),
			),
			array(
				'id'      => 'title',
				'type'    => 'text',
				'title'   => esc_html__('Title','bytesed'),
			),
			array(
				'id'      => 'link',
				'type'    => 'text',
				'title'   => esc_html__('Link','bytesed'),
			)
		)
	) );

	/*------------------------------------
		info item Text
	-------------------------------------*/
	CSF::createSection( $prefix.'_shortcodes', array(
		'title'     => esc_html__('Info Item Text','bytesed'),
		'view'      => 'group',
		'shortcode' => 'bytesed_info_text_wrap',
		'group_shortcode' => 'bytesed_info_text_item',
		'group_fields'    => array(
			array(
				'id'    => 'icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon','bytesed'),
			),
			array(
				'id'      => 'text',
				'type'    => 'text',
				'title'   => esc_html__('Text','bytesed'),
			)
		)
	) );

}
