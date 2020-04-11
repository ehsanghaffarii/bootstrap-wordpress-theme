<?php
/**
 * 
 * template for single article
 * 
 * @package EIN_Bootstrap_Theme
 * 
 */
get_header();
// $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
// echo '<img class="rounded-lg" src="'.$src[0].'">';
the_title( '<h1 class="entry-title border-0">', '</h1>' );
?>

<?php
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ein_bootstrap_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>

			<div class="row m-0">

            <section id="primary" class="content-area col-sm-9">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			    the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

    <?php
get_sidebar();
get_footer();