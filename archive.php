<?php
/**
 * The template for displaying articles pages
 *
 *
 * @package EIN_Bootstrap_Theme
 */

get_header(); ?>

<header class="entry-header bg-dark">
    <h1 class="entry-title"><?php echo esc_html__( 'آرشیو پنجره گلدوین') ?> </h1>
</header><!-- .page-header -->

<?php
if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('
<p id="breadcrumbs" class="custom-breadcrumbs" >','</p>
');
}
?>

<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page'       => -1,
        );
        $query = new WP_Query( $args );

if($query->have_posts()) { ?>

<div class="row m-0">

<section id="primary" class="content-area col-sm-9 col-lg-9">
    <main id="main" class="site-main" role="main">
        
			
<?php
    
        while($query->have_posts()) {
            $query->the_post();
            $thumb_id = get_post_thumbnail_id();
            $thumb_url = wp_get_attachment_image_src($thumb_id,'full',true);
            // $type = get_post_meta(get_the_ID(),'article_info_articletype',true);
            // $date = get_post_meta(get_the_ID(),'article_info_publication-date',true);
            // $stras = get_post_meta(get_the_ID(),'article_info_stars', true);
            ?>
                <div class="col">
                    <div class="card mb-1 bg-gradiant-1">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                              <img class="card-img" src="<?php echo $thumb_url[0];?>"></img>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-2 px-4">
                                    <h5 class="card-title text-white"> <?php echo get_the_title(); ?> </h5>
                                    <div class="mata-box-content text-white">
                                        <p class="card-text"> <?php echo get_the_author(); ?></p>
                                        
                                    </div>
                                    
                                <a href="<?php echo get_the_permalink();?>" title="<?php echo get_the_title();?>" class="btn btn-warning px-4 py-2">دیدن مقاله</a>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }

        ?>
<?php

}
else {
    echo "<p style='text-align:center'>هیج مقاله ای پیدا نشد</p>";
}
?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>