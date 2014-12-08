<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php 
		if (is_singular())
			the_title('<h1 class="entry-title">', '</h1>');
		else
			the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>');
		?>


		<?php if ('post' == get_post_type()): ?>
		<div class="entry-meta">
			<?php get_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
		if (has_post_thumbnail()): 

			if (is_singular()): 
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail('large'); ?>
			</div>

			<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('thumbnail'); ?>
			</a>

			<?php 
			endif;

		endif; 
		?>

		<?php the_content(__('Continue reading') . ' <span class="meta-nav">&rarr;</span>'); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php get_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

<?php  
if (is_singular() && comments_open())
	comments_template();
?>