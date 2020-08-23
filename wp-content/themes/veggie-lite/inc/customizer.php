<?php
/**
 * Veggie Theme Customizer
 *
 * @package Veggie Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function veggie_lite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_section( 'veggie_lite_general_options', array(
		'title'             => esc_html__( 'Theme Options', 'veggie-lite' ),
		'priority'          => 1,
	) );
	/**
	* Search Bar
	*/
	$wp_customize->add_setting( 'veggie_lite_search_top', array(
		'default'           => false,
		'sanitize_callback' => 'veggie_lite_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'veggie_lite_search_top', array(
		'label'             => esc_html__( 'Hide Search Box', 'veggie-lite' ),
		'section'           => 'veggie_lite_general_options',
		'settings'          => 'veggie_lite_search_top',
		'type'		        => 'checkbox',
		'priority'          => 1,
	) );
	
	/* Post Settings */
	$wp_customize->add_setting( 'veggie_lite_post_footer', array(
		'default'           => false,
		'sanitize_callback' => 'veggie_lite_sanitize_checkbox',
	) );
	$wp_customize->add_control('veggie_lite_post_footer', array(
				'label'      => esc_html__( 'Hide post author and date from posts.', 'veggie-lite' ),
				'section'    => 'veggie_lite_general_options',
				'settings'   => 'veggie_lite_post_footer',
				'type'		 => 'checkbox',
				'priority'	 => 2
		) );

	$wp_customize->add_setting( 'veggie_lite_author_bio', array(
		'default'           => false,
		'sanitize_callback' => 'veggie_lite_sanitize_checkbox',
	) );
	$wp_customize->add_control('veggie_lite_author_bio', array(
				'label'      => esc_html__( 'Hide author bio ("published by" box).', 'veggie-lite' ),
				'section'    => 'veggie_lite_general_options',
				'settings'   => 'veggie_lite_author_bio',
				'type'		 => 'checkbox',
				'priority'	 => 3
		) );

	/**
	* Adds the individual sections for copyright
	*/
	$wp_customize->add_section( 'veggie_lite_copyright_section' , array(
		'title'    => esc_html__( 'Copyright Settings', 'veggie-lite' ),
	) );

	$wp_customize->add_setting( 'veggie_lite_copyright', array(
		'default'           => esc_html__( 'Proudly powered by WordPress. Built with veggie Lite WordPress Theme', 'veggie-lite' ),
		'sanitize_callback' => 'veggie_lite_sanitize_text',
	) );
	$wp_customize->add_control( 'veggie_lite_copyright', array(
		'label'             => esc_html__( 'Copyright text', 'veggie-lite' ),
		'section'           => 'veggie_lite_copyright_section',
		'settings'          => 'veggie_lite_copyright',
		'type'		        => 'text',
		'priority'          => 1,
	) );

	$wp_customize->add_setting( 'hide_copyright', array(
		'sanitize_callback' => 'veggie_lite_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'hide_copyright', array(
		'label'             => esc_html__( 'Hide copyright text', 'veggie-lite' ),
		'section'           => 'veggie_lite_copyright_section',
		'settings'          => 'hide_copyright',
		'type'		        => 'checkbox',
		'priority'          => 2,
	) );
	
/**
* Custom CSS
*/
	$wp_customize->add_section( 'veggie_lite_custom_css_section' , array(
		'title'    => esc_html__( 'Custom CSS', 'veggie-lite' ),
		'description'=> 'Add your custom CSS which will overwrite the theme CSS',
		'priority'   => 32,
	) );

	/* Custom CSS*/
	$wp_customize->add_setting( 'veggie_lite_custom_css', array(
		'default'           => '',
		'sanitize_callback' => 'veggie_lite_sanitize_text',
	) );
	$wp_customize->add_control( 'veggie_lite_custom_css', array(
		'label'             => esc_html__( 'Custom CSS', 'veggie-lite' ),
		'section'           => 'veggie_lite_custom_css_section',
		'settings'          => 'veggie_lite_custom_css',
		'type'		        => 'textarea',
		'priority'          => 1,
	) );
/**
* Migrating Custom CSS to the core Additional CSS if user uses WordPress 4.7.
*
* @since Veggie 1.2
*/
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		$custom_css = get_theme_mod( 'veggie_lite_custom_css' );
		if ( $custom_css ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return = wp_update_custom_css_post( $core_css . $custom_css );
			if ( ! is_wp_error( $return ) ) {
				// Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
				remove_theme_mod( 'veggie_lite_custom_css');
			}
		}
		$wp_customize->remove_control( 'veggie_lite_custom_css' );
	}


	/***** Register Custom Controls *****/

	class veggie_lite_Upgrade extends WP_Customize_Control {
		public function render_content() {  ?>
			<p class="didi-upgrade-thumb">
				<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
			</p>
			<p class="customize-control-title didi-upgrade-title">
				<?php esc_html_e('Veggie Pro', 'veggie-lite'); ?>
			</p>
			<p class="textfield didi-upgrade-text">
				<?php esc_html_e('Full version of this theme includes additional features; additional page templates, custom widgets, additional front page widgetized areas, different blog options, different theme options, WooCommerce support, color options & premium theme support.', 'veggie-lite'); ?>
			</p>
			<p class="customize-control-title didi-upgrade-title">
				<?php esc_html_e('Additional Features:', 'veggie-lite'); ?>
			</p>
			<ul class="didi-upgrade-features">
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Additional Page Templates', 'veggie-lite'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Custom Widgets', 'veggie-lite'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Several additional widget areas', 'veggie-lite'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Different Blog Options & Layouts', 'veggie-lite'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Different Theme Options', 'veggie-lite'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('WooCommerce Support', 'veggie-lite'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Color Options', 'veggie-lite'); ?>
				</li>
				<li class="didi-upgrade-feature-item">
					<?php esc_html_e('Premium Theme Support', 'veggie-lite'); ?>
				</li>
			</ul>
			<p class="didi-upgrade-button">
				<a href="http://www.anarieldesign.com/themes/food-blog-wordpress-theme/" target="_blank" class="button button-secondary">
					<?php esc_html_e('Read more about Veggie', 'veggie-lite'); ?>
				</a>
			</p><?php
		}
	}

	/***** Add Sections *****/

	$wp_customize->add_section('veggie_lite_upgrade', array(
		'title' => esc_html__('Pro Features', 'veggie-lite'),
		'priority' => 300
	) );

	/***** Add Settings *****/

	$wp_customize->add_setting('veggie_lite_options[premium_version_upgrade]', array(
		'default' => '',
		'type' => 'option',
		'sanitize_callback' => 'esc_attr'
	) );

	/***** Add Controls *****/

	$wp_customize->add_control(new veggie_lite_Upgrade($wp_customize, 'premium_version_upgrade', array(
		'section' => 'veggie_lite_upgrade',
		'settings' => 'veggie_lite_options[premium_version_upgrade]',
		'priority' => 1
	) ) );
	
}
add_action( 'customize_register', 'veggie_lite_customize_register' );

/**
 * Sanitization
 */
//Checkboxes
function veggie_lite_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}
//Integers
function veggie_lite_sanitize_int( $input ) {
	if( is_numeric( $input ) ) {
		return intval( $input );
	}
}
//Text
function veggie_lite_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function veggie_lite_customize_preview_js() {
	wp_enqueue_script( 'veggie_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20150908', true );
}
add_action( 'customize_preview_init', 'veggie_lite_customize_preview_js' );
/***** Enqueue Customizer CSS *****/

function veggie_lite_customizer_base_css() {
	wp_enqueue_style('veggie-customizer', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'veggie_lite_customizer_base_css');