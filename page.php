<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EIN_Bootstrap_Theme
 */

get_header(); ?>

      <div class="entry-header bg-dark">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title border-0">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ein_bootstrap_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
</div><!-- .entry-header -->
			<div class="row m-0">


	<section id="primary" class="content-area col-sm-9">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/single-page-custom', 'page' );

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
