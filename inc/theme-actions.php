<?php

add_action('after_setup_theme', function(){

	// Makes theme available for translation.
	load_theme_textdomain( 'wpstartertheme', get_template_directory() . '/languages' );


	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	add_theme_support('title-tag');


    register_nav_menu('top', __('Top Menu'));
	register_nav_menu('primary', __('Primary Menu'));
	register_nav_menu('footer', __('Footer Menu'));


	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	));

});


/**
 * Styles for front-end and back-end.
 */
function enqueue_site_styles()
{
    // Google fonts
    wp_enqueue_style('google-font-1', '//fonts.googleapis.com/css?family=Lato:400');


    // Font Awesome
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/vendor/fontawesome/css/font-awesome.min.css');
}


add_action('admin_enqueue_scripts', function(){
    enqueue_site_styles();
});


add_action('wp_enqueue_scripts', function(){

    if (!is_admin())
    {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri() . '/vendor/jquery/dist/jquery.min.js');
    }


    enqueue_site_styles();


	wp_enqueue_style('site-styles', get_template_directory_uri() . '/css/main.css', array('bootstrap', 'google-font-1'), filemtime(get_template_directory() . '/css/main.css'));
	wp_enqueue_script('site-scripts', get_template_directory_uri() . '/js/main.js', array('jquery'), filemtime(get_template_directory() . '/js/main.js'), true );


    // Bootstrap
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/dist/js/bootstrap.min.js', array(), null, true );
	

	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script('comment-reply');
	}

});


add_action('widgets_init', function(){

	$sidebar_defaults = array(
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    );

    $sidebars_list = array(
        // sidebar name => sidebar params
        // =============================
        'top' => array(),
        'header' => array(),
        'offcanvas' => array(),
        'sidebar' => array(
        	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        	'after_widget'  => '</aside>',
    	),
        'footer' => array(),
    );

    foreach ($sidebars_list as $sidebar_name => $sidebar_params) 
    {
        register_sidebar(array_merge($sidebar_defaults, array(
            'name' => $sidebar_name,
            'id' => sanitize_title($sidebar_name),
        ), $sidebar_params));
    }

});


add_action('wp_head', function(){

	printf('<!--[if lt IE 9]><script src="%1$s/vendor/IE9/index.js.js" type="text/javascript"></script>'
	. '<script src="%1$s/vendor/respond/dest/respond.min.js" type="text/javascript"></script><![endif]-->', get_template_directory_uri());

});


add_action('init', function(){

	add_editor_style('css/editor-style.css');

});


add_action('admin_init', function(){
   
    add_editor_style(get_template_directory_uri() . '/css/editor-style.css');

});
