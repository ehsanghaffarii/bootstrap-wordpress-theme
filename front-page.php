<?php

$activeImg = '/wp-content/themes/ein-upvc/images/activeImg.png';

$images = array(
	'/wp-content/themes/ein-upvc/images/Slide-1.jpg',
	'/wp-content/themes/ein-upvc/images/Slide-2.jpg',
);
// $images_index = rand(0, count($images)-1);
// $image1 = $images[$images_index];


/**
 * Template Name: Front Page Template
 * @package EIN_Bootstrap_Theme
 */

get_header(); ?>

<div class="row m-0">


<section id="primary" class="content-area col-sm-9">

<div id="carouselExampleControls" class="carousel slide carousel-fade"  data-ride="carousel">

		<div class="carousel-inner">
		
			<div class="carousel-item active" data-interval="2000" >
					<img class="d-block" src="<?php echo $activeImg;  ?>">
			</div>
    <?php $i=0; foreach ($images as $image){?>
			<div class="carousel-item active" if ($active)  data-interval="5000">
					<img class="d-block" src="<?php echo $image;  ?>">
			</div>	
        <?php $i++; } ?>
		</div>
               
</div>



		<main id="main" class="site-main" role="main">

        <?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/front-page-template', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

			endwhile; // End of the loop.
			?>

			<div class="article-section">
		    <h3>مقالات گلدوین
				<a class="btn btn-warning" href="<?php echo site_url(); ?>/article/">دیدن همه</a>
			</h3>
			<?php $args = array(
				'post_type' => 'Article',
				'order' => 'desc',
				'posts_per_page' => '2',
            ); 
            
			$works = new WP_Query( $args );

			if ( $works->have_posts() ) :  while ( $works->have_posts() ) : $works->the_post(); ?>

			<a class="post btn btn-info btn-block d-inline-flex text-right bg-gradiant-1" id="post-<?php the_ID(); ?>" href="/article/<?php echo the_permalink(); ?>" target="_blank">
			<?php if ( get_post_thumbnail_id() ) : ?>
			<div class="post-thumbnail">
			<img src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>" alt="<?php the_title(); ?>" height="30" width="30">
			</div>
			<?php endif; ?>	
				<div class="post-title text-white"><?php the_title(); ?></div>
			<span class="post-date"><time><?php the_time( 'F j, Y' ); ?></time></span>
			</a>

		<?php endwhile; endif; wp_reset_postdata(); ?>
			
		</div>
			
		</main><!-- #content -->
	</section><!-- #primary -->
<?php get_sidebar( ); ?>

<?php get_footer(); ?>