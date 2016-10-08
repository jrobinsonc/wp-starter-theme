<?php

/**
 * show_pagination
 *
 * Show pagination links.
 *
 * @author JoseRobinson.com
 * @link https://gist.github.com/jrobinsonc/bb3829f9418d37c02a09
 * @version 2.0.0
 * @param object $custom_query An instance of the WP_Query class
 * @param string $container HTML container for the pagination links
 * @param array $config See https://codex.wordpress.org/Function_Reference/paginate_links
 * @return void
 */
function show_pagination($custom_query = null, $container = '<div class="pagination-box">%s</div>', $config = array())
{
    if (null === $custom_query)
        global $wp_query;
    else
        $wp_query = $custom_query;


    $big = 999999999;

    $pagination_array = array_merge(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, absint(get_query_var('paged'))),
        'total' => $wp_query->max_num_pages,
        // 'prev_text' => __('Â« Atras'),
        // 'next_text' => __('Siguiente Â»')
    ), $config);

    $pagination = paginate_links($pagination_array);

    if (is_null($pagination))
        return;

    printf($container, $pagination);
}


/**
 * get_thumb_tag
 *
 * @author JoseRobinson.com
 * @link https://gist.github.com/jrobinsonc/3959a3c40138fdb701c8
 * @param int $post_id
 * @param mixed $size
 * @param boolean $caption
 * @return string
 */
function get_thumb_tag($post_id, $size, $caption = true)
{
    $thumbnail_id = get_post_thumbnail_id($post_id);
    $image_obj = wp_get_attachment_image_src($thumbnail_id, $size);
    $post_info = get_post($thumbnail_id);

    // $image_obj[1], $image_obj[2]

    $result = sprintf('<figure class="post-media-%s">', $thumbnail_id);
    $result .= sprintf('<img src="%s" alt="%s" />', $image_obj[0], esc_attr($post_info->post_excerpt));

    if (true === $caption)
    {
        if ($post_info->post_content !== '')
            $result .= sprintf('<p>“%s”</p>', $post_info->post_content);

        if ($post_info->post_excerpt !== '')
            $result .= sprintf('<figcaption>%s</figcaption>', $post_info->post_excerpt);
    }

    $result .= sprintf('</figure>');

    return $result;
}

function show_post_thumbnail()
{
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }

    if ( is_singular() ) : ?>

    <span class="post-thumbnail">
        <?php the_post_thumbnail(); ?>
    </span>

    <?php else : ?>

    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
        <?php the_post_thumbnail( 'post-thumbnail', ['alt' => get_the_title()] ); ?>
    </a>

    <?php endif;
}

/**
 * show_menu
 *
 * @author JoseRobinson.com
 * @link https://gist.github.com/jrobinsonc/932b7b7d3b724ac4be0399a81e1b3c08
 * @version 1.0.0
 * @param string $location
 * @param array $args
 * @return string
 */
function show_menu($location, $args = [])
{
    $def_args = array_merge([
        'theme_location' => $location,
        'container' => 'nav', // Here we are using NAV tag as container.
        'container_class' => $location . '-menu menu clearfix', //
    ], $args);

    $def_args['echo'] = false;

    $menu = wp_nav_menu($def_args);

    // WordPress adds a generic ID to the container,
    // this code removes this ID if it was not specified in the arguments.
    if (! isset($args['menu_id']))
        $menu = preg_replace('#<ul(.+)id="[^"]+"(.+)>#mU', '<ul$1$2>', $menu);

    $menu = preg_replace('#<a(.+)href="(/[^"]+)"(.*)>#U', '<a$1href="'. get_bloginfo('url') .'$2"$3>', $menu);

    echo $menu;
}
