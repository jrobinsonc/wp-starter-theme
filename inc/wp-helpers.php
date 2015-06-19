<?php

/**
 * show_pagination
 *
 * Show pagination links.
 *
 * @author JoseRobinson.com
 * @link https://gist.github.com/jrobinsonc/bb3829f9418d37c02a09
 * @license MIT
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


function get_posted_on() 
{
    $time_string = sprintf('<time class="entry-date" datetime="%1$s">%2$s</time>',
        esc_attr(get_the_date('c')),
        esc_html(get_the_date())
    );

    $posted_on = sprintf(_x('Posted on %s', 'post date'), $time_string);

    $byline = sprintf(_x('by %s', 'post author'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>',
    '<span class="byline"> ' . $byline . '</span>';
}


function get_entry_footer() 
{
    if ('post' == get_post_type()) 
    {
        $categories_list = get_the_category_list(', ');

        if ($categories_list)
            printf('<div class="cat-links">' . __('Posted in: %1$s') . '</div>', $categories_list);


        $tags_list = get_the_tag_list('', ', ');

        if ($tags_list)
            printf('<div class="tags-links">' . __('Tags: %1$s') . '</div>', $tags_list);
    }

    if (! is_single() && ! post_password_required() && comments_open()) 
    {
        echo '<div class="comments-link">';
        comments_popup_link(__('Leave a comment'), __('1 Comment'), __('% Comments'));
        echo '</div>';
    }
}
