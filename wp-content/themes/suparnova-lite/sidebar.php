<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Suparnova
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="<?php suparnova_lite_right_sidebar_class(); ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
