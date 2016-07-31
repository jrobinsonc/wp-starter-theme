<?php get_template_part('partials/layout-start'); ?>

<?php if (have_posts()) : ?>

    <?php get_template_part('partials/page-title') ?>

    <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('content', get_post_format()); ?>
    <?php endwhile; ?>

    <?php
    the_posts_pagination(array(
        'prev_text' => __( 'Previous page'),
        'next_text' => __( 'Next page'),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page') . ' </span>',
    ));
    ?>

<?php else : ?>
    <?php get_template_part('content', 'none'); ?>
<?php endif; ?>

<?php get_template_part('partials/layout-end'); ?>
