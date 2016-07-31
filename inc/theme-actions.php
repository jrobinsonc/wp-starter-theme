<?php

add_action('after_setup_theme', function(){

	// Makes theme available for translation.
	load_theme_textdomain( 'wpstartertheme', get_template_directory() . '/languages' );


	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	add_theme_support('title-tag');


	register_nav_menu('primary', __('Primary Menu'));
	register_nav_menu('footer', __('Footer Menu'));


	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	));

});

add_action('admin_init', function(){

	add_editor_style('css/editor-style.min.css');

});
