<?php
/**
 * Template part for the diff table in welcome screen
 *
 * @package Epsilon Framework
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Features
 */
$medzone = wp_get_theme();

$features = array(
	'frontpage-sections'    => array(
		'label'        => __( 'Frontpage sections', 'medzone-lite' ),
		'medzone-lite' => __( 'Limited', 'medzone-lite' ),
		'medzone-pro'  => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'layout-control'        => array(
		'label'        => __( 'Blog & Page layout control', 'medzone-lite' ),
		'medzone-lite' => __( 'Limited', 'medzone-lite' ),
		'medzone-pro'  => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'footer-layout-control' => array(
		'label'        => __( 'Footer layout control', 'medzone-lite' ),
		'medzone-lite' => __( 'Limited', 'medzone-lite' ),
		'medzone-pro'  => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'post-formats'          => array(
		'label'        => __( 'Post formats', 'medzone-lite' ),
		'medzone-lite' => __( 'Limited', 'medzone-lite' ),
		'medzone-pro'  => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'color-schemes'         => array(
		'label'        => __( 'Color schemes', 'medzone-lite' ),
		'medzone-lite' => '<span class="dashicons dashicons-no-alt"></span>',
		'medzone-pro'  => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'typography'            => array(
		'label'        => __( 'Typography', 'medzone-lite' ),
		'medzone-lite' => __( 'Limited', 'medzone-lite' ),
		'medzone-pro'  => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'multiple-layouts'      => array(
		'label'        => __( 'Multiple blog layouts', 'medzone-lite' ),
		'medzone-lite' => '<span class="dashicons dashicons-no-alt"></span>',
		'medzone-pro'  => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'priority-support'      => array(
		'label'        => __( 'Priority support', 'medzone-lite' ),
		'medzone-lite' => '<span class="dashicons dashicons-no-alt"></span>',
		'medzone-pro'  => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'security-updates'      => array(
		'label'        => __( 'Security updates & feature releases', 'medzone-lite' ),
		'medzone-lite' => '<span class="dashicons dashicons-no-alt"></span>',
		'medzone-pro'  => '<span class="dashicons dashicons-yes"></span></i>',
	),
);
?>
<div class="featured-section features">
	<table class="free-pro-table">
		<thead>
		<tr>
			<th></th>
			<th><?php echo __( 'MedZone Lite', 'medzone-lite' ); ?></th>
			<th><?php echo __( 'MedZone PRO', 'medzone-lite' ); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ( $features as $feature ) : ?>
			<tr>
				<td class="feature">
					<h3>
						<?php echo wp_kses_post( $feature['label'] ); ?>
					</h3>
				</td>
				<td class="epsilon-feature">
					<?php echo wp_kses_post( $feature['medzone-lite'] ); ?>
				</td>
				<td class="epsilon-feature">
					<?php echo wp_kses_post( $feature['medzone-pro'] ); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td></td>
			<td colspan="2" class="text-right">
				<a href="https://www.machothemes.com/theme/medzone-pro/?utm_source=worg&utm_medium=about-page&utm_campaign=upsell" target="_blank" class="button button-primary button-hero"><span class="dashicons dashicons-cart"></span>
					<?php echo __( 'Get MedZone Pro!', 'medzone-lite' ); ?></a></td>
		</tr>
		</tbody>
	</table>
</div>
