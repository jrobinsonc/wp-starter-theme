<?php

add_action('after_setup_theme', function(){

	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	add_theme_support('title-tag');


	register_nav_menu('primary', __('Primary Menu'));
	register_nav_menu('footer', __('Footer Menu'));


	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	));

});


add_action('wp_enqueue_scripts', function(){

	wp_enqueue_style('site-style', get_stylesheet_uri());
	wp_enqueue_style('site-style-main', get_template_directory_uri() . '/css/main.css', array(), filemtime(get_template_directory() . '/css/main.css'));
	wp_enqueue_script('site-scripts', get_template_directory_uri() . '/js/main.js', array(), filemtime(get_template_directory() . '/js/main.js'), true );
	

	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script('comment-reply');
	}

});


add_action('widgets_init', function(){

	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
});


add_action('wp_head', function(){

	printf('<!--[if lt IE 9]><script src="%1$s/vendor/IE9/index.js.js" type="text/javascript"></script>'
	. '<script src="%1$s/vendor/respond/dest/respond.min.js" type="text/javascript"></script><![endif]-->', get_template_directory_uri());

});


add_action('init', function(){

	add_editor_style('css/editor-style.css');

});