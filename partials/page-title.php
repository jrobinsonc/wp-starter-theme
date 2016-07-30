<?php

if (is_home()) {
    if (get_option('page_for_posts', true)) {
        $page_title = get_the_title(get_option('page_for_posts', true));
    } else {
        $page_title = __('Latest Posts');
    }
} elseif (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

    if ($term) {
        $page_title = $term->name;
    } elseif (is_post_type_archive()) {
        $page_title = get_queried_object()->labels->name;
    } elseif (is_day()) {
        $page_title = sprintf(__('Daily Archives: %s'), get_the_date());
    } elseif (is_month()) {
        $page_title = sprintf(__('Monthly Archives: %s'), get_the_date('F Y'));
    } elseif (is_year()) {
        $page_title = sprintf(__('Yearly Archives: %s'), get_the_date('Y'));
    } elseif (is_author()) {
        $author = get_queried_object();
        $page_title = sprintf(__('Author Archives: %s'), '<small>' . $author->display_name . '</small>');
    } else {
        $page_title = single_cat_title('', false);
    }
} elseif (is_search()) {
    $page_title = sprintf(__('Search Results for: %s'), '<small>' . get_search_query() . '</small>');
} elseif (is_404()) {
    $page_title = __('Nothing Found');
}

if (isset($page_title)) :
?>

    <header class="page-header">
        <h1 class="page-title"><?php echo $page_title; ?></h1>
    </header>

<?php
endif;
