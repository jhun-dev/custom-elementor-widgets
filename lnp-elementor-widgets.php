<?php
/**
 * Plugin Name: LNP Elementor Widgets
 * Description: Elementor custom widgets from Elnp Web Apps.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      lnp Web Apps
 * Author URI:  https://developers.elementor.com/
 * Text Domain: lnp-elementor-widget
 *
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Widgets.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */

function register_lnp_custom_widgets( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/lnp-timeline-widget.php' );
    require_once( __DIR__ . '/widgets/lnp-testimonial-widget.php' );

    $widgets_manager->register( new \Lnp_Elementor_Timeline_Widget() ); 
    $widgets_manager->register( new \Lnp_Elementor_Testimonial_Widget() ); 

}
add_action( 'elementor/widgets/register', 'register_lnp_custom_widgets' );



add_action( 'wp_enqueue_scripts', function () {
    wp_register_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
        [], // deps
        '3.12.2',
        true // in footer
    );
    wp_register_script(
        'gsap-scrolltrigger',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
        [ 'gsap' ],
        '3.12.5',
        true
    );
    wp_register_script(
        'lnp-timeline-js',
        plugins_url( 'assets/js/lnp-timeline-widget-script.js', __FILE__ ),
        [ 'jquery', 'gsap', 'gsap-scrolltrigger', 'elementor-frontend' ], // deps
        '1.0.0',
        true // in footer
    );
    wp_register_script(
        'lnp-testimonial-js',
        plugins_url( 'assets/js/lnp-testimonial-widget-script.js', __FILE__ ),
        [ 'jquery', 'swiper', 'elementor-frontend' ], // deps
        '1.0.0',
        true // in footer
    );
    wp_register_style(
        'lnp-timeline-css',
        plugins_url( 'assets/css/lnp-timeline-widget.css', __FILE__ ),
        [],
        '1.0.0'
    );
    wp_register_style(
        'lnp-testimonial-css',
        plugins_url( 'assets/css/lnp-testimonial-widget.css', __FILE__ ),
        [],
        '1.0.0'
    );

}, 20 );


