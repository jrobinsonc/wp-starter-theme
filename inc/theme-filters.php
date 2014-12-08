<?php

add_filter('body_class', function ($classes)
{
	global $post;

	$classes[] = is_page() && isset($post->post_name)? "page-{$post->post_name}" : '';
	$classes[] = is_front_page()? '' : 'not-home';

	return $classes;
});
