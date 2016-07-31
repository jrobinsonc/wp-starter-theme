<?php

add_filter('body_class', function ($classes)
{
	global $post;

    // Adds "not-home" class to pages.
    if (! is_front_page())
        $classes[] = 'not-home';


	return $classes;
});


/**
 * Execute shortcodes within widgets.
 */
add_filter('widget_text', 'do_shortcode');
