<?php
/**
 * Template part for the getting started tab in welcome screen
 *
 * @package Epsilon Framework
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Getting started template
 */
$customizer_url = admin_url() . 'customize.php';
$count          = $this->count_actions();
?>

<div class="feature-section three-col">
	<div class="col">
		<h3><?php esc_html_e( 'Step 1 - Implement recommended actions', 'epsilon-framework' ); ?></h3>
		<p><?php esc_html_e( 'We\'ve compiled a list of steps for you, to take make sure the experience you\'ll have using one of our products is very easy to follow.', 'epsilon-framework' ); ?></p>
		<?php if ( 0 === $count ) { ?>
			<p><span class="dashicons dashicons-yes"></span>
				<a href="<?php echo esc_url( $this->generate_admin_url( 'recommended-actions' ) ); ?>"><?php esc_html_e( 'No recommended actions left to perform', 'epsilon-framework' ); ?></a>
			</p>
		<?php } else { ?>
			<p><span class="dashicons dashicons-no-alt"></span>
				<a href="<?php echo esc_url( $this->generate_admin_url( 'recommended-actions' ) ); ?>"><?php esc_html_e( 'Check recommended actions', 'epsilon-framework' ); ?></a>
			</p>
		<?php }; ?>
	</div><!--/.col-->

	<div class="col">
		<h3><?php esc_html_e( 'Step 2 - Check our documentation', 'epsilon-framework' ); ?></h3>
		<p><?php esc_html_e( 'Even if you\'re a long-time WordPress user, we still believe you should give our documentation a very quick Read.', 'epsilon-framework' ); ?></p>
		<p>
			<a target="_blank" href="<?php echo esc_url( 'http://docs.machothemes.com/collection/123-medzone' ); ?>"><?php esc_html_e( 'Full documentation', 'epsilon-framework' ); ?></a>
		</p>
	</div><!--/.col-->

	<div class="col">
		<h3><?php esc_html_e( 'Step 3 - Customize everything', 'epsilon-framework' ); ?></h3>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'epsilon-framework' ); ?></p>
		<p>
			<a target="_blank" href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'epsilon-framework' ); ?></a>
		</p>
	</div><!--/.col-->

	<div class="col-fulwidth">
		<h3><?php esc_html_e( 'Lend a hand & share your thoughts', 'epsilon-framework' ); ?></h3>
		<p>
			<?php
			echo vsprintf(
				// Translators: 1 is Theme Name, 2 is opening Anchor, 3 is closing.
				__( 'We\'ve been working hard on making %1$s the best one out there. We\'re interested in hearing your thoughts about %1$s and what we could do to make it even better.<br/> <br/> %2$sHave your say%3$s<br/> <br/> <em>Note: A 10%% discount coupon will be emailed to you after form submission. Please use a valid email address.</em>', 'medzone-lite' ),
				array(
					'MedZone Lite',
					'<a class="button button-feedback" target="_blank" href="https://bit.ly/medzone-feedback">',
					'</a>',
				)
			);
			?>
		</p>
	</div>
</div><!--/.feature-section-->
