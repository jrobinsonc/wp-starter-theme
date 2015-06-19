<?php

add_filter('body_class', function ($classes)
{
	global $post;


	$classes[] = is_page() && isset($post->post_name)? "page-{$post->post_name}" : '';


    // Deletes "page" class from homepage.
    if (is_front_page())
    {
        $index = array_search('page', $classes);
        unset($classes[$index]);
    }
    // This adds "not-home" class to pages.
    else
    {
        $classes[] = 'not-home';
    }


	return $classes;
});


/**
 * Execute PHP from widgets.
 */
add_filter('widget_text', function ($html){

    if(strpos($html, "<"."?php") !== false)
    {
        ob_start(); 
        eval("?".">".$html);
        $html = ob_get_contents();
        ob_end_clean();
    }

    return $html;

}, 100);


/**
 * Execute shortcodes within widgets.
 */
add_filter('widget_text', 'do_shortcode');