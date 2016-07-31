<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

    <?php show_post_thumbnail(); ?>

    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink())), '</a></h2>');
        endif;
        ?>
    </header>

	<?php if (is_single()): ?>

    <div class="entry-meta">
        <?php

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

        ?>
    </div><!-- .entry-meta -->

    <?php endif; ?>


	<?php if (is_singular()): ?>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>

	<?php else: ?>

    <div class="entry-summary">

        <?php
        if (has_excerpt())
            the_excerpt();
        else
            the_content();
        ?>

    </div>

  	<?php endif; ?>


	<?php if (is_singular()): ?>

	<footer class="entry-footer">
		<?php

		if ('post' == get_post_type())
		{
		    $categories_list = get_the_category_list(', ');

		    if ($categories_list)
		        printf('<div class="cat-links">' . __('Posted in: %1$s') . '</div>', $categories_list);


		    $tags_list = get_the_tag_list('', ', ');

		    if ($tags_list)
		        printf('<div class="tags-links">' . __('Tags: %1$s') . '</div>', $tags_list);
		}

		?>
	</footer><!-- .entry-footer -->

	<?php endif; ?>


</article><!-- #post-## -->

<?php
if (is_singular() && comments_open())
	comments_template();
?>
