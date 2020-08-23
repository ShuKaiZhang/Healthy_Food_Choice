<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Veggie Lite
 */

?>

	</div><!-- #content -->

	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>

	<footer id="colophon" class="site-footer" role="contentinfo">

			<div class="footer-widgets clear">

				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>

					<div class="widget-area">

						<?php dynamic_sidebar( 'footer-1' ); ?>

					</div><!-- .widget-area -->

				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>

					<div class="widget-area">

						<?php dynamic_sidebar( 'footer-2' ); ?>

					</div><!-- .widget-area -->

				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>

					<div class="widget-area">

						<?php dynamic_sidebar( 'footer-3' ); ?>

					</div><!-- .widget-area -->

				<?php endif; ?>

			</div><!-- .footer-widgets -->

	</footer><!-- #colophon -->
	<?php endif; ?>
	<?php if( get_theme_mod( 'hide_copyright' ) == '') { ?>
	<div class="site-info" role="contentinfo">
		<div class="copyright">
		<?php
			if ( function_exists( 'the_privacy_policy_link' ) ) {
			the_privacy_policy_link( '', '<span role="separator" aria-hidden="true">|</span>' );
			}
		?>
		<?php
			/**
			* Fires before the Veggie Lite footer text for footer customization.
			*
			* @since Veggie Lite 1.0
			*/
			do_action( 'veggie_lite_credits' );
		?>
		<?php if(!get_theme_mod('veggie_lite_copyright')) : ?>
		    <a href="<?php echo esc_url( esc_html__( 'https://www.anarieldesign.com/free-food-recipes-wordpress-theme/', 'veggie-lite' ) ); ?>"><?php printf( esc_html__( 'Theme: %1$s', 'veggie-lite' ), 'Veggie Lite' ); ?></a>
		<?php else: ?>
		    <?php esc_attr_e('&copy;', 'veggie-lite'); ?>
		    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"> <?php echo esc_html( get_theme_mod( 'veggie_lite_copyright', __( 'Built using Veggie Lite Theme. Proudly powered by WordPress.', 'veggie-lite' ) ) ); ?> </a>
		<?php endif; ?>
	    </div>
	</div><!-- .site-info -->
	<?php } // end if ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>