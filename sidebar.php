<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EIN_Bootstrap_Theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-sm-12 col-lg-3 mt-4" role="complementary">

	<div class="">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>

</aside><!-- #secondary -->
