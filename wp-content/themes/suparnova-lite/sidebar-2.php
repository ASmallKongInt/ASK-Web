<?php
/**
 * The sidebar containing the second widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Suparnova
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<aside id="tertiary" class="<?php suparnova_lite_left_sidebar_class(); ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside>
