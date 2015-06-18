<?php

/**
 * @link https://gist.github.com/jrobinsonc/bb3829f9418d37c02a09
 */
function show_pagination($container = '<div class="pagination-box">%s</div>')
{
    global $wp_query;

    $big = 999999999;

    $pagination_array = array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, absint(get_query_var('paged'))),
        'total' => $wp_query->max_num_pages,
        // 'prev_text' => '',
        // 'next_text' => ''
    );

    $pagination = paginate_links($pagination_array);

    if (is_null($pagination)) 
        return;

    printf($container, $pagination);
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
