<?php 

use \Elementor\Plugin as Plugin;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Elementor_Ihcoderdov_Extension {

	const VERSION = '1.0.0';

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	const MINIMUM_PHP_VERSION = '5.6';

	private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	public function i18n() {

		load_plugin_textdomain( 'ihcoderdov' );

	}
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered',[$this,'register_new_category']);
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'ihcoderdov_register_frontend_scripts'),10);
		add_action( 'wp_enqueue_scripts', array( $this, 'ihcoderdov_register_frontend_styles' ), 10 );

		
	}	

	public function ihcoderdov_register_frontend_scripts() {
			 wp_enqueue_script(
            'ihcoderdov-owl-carousel',
	            IHCODERDOV_URI . 'assets/js/owl.carousel.min.js',
	            array('jquery'),
	            IHCODERDOV_VERSION,
	            true
	        );

			wp_enqueue_script(
            'ihcoderdov_slider',
	            IHCODERDOV_URI . 'assets/js/slider.js',
	            array('jquery', 'ihcoderdov-owl-carousel'),
	            IHCODERDOV_VERSION,
	            true
	        );

	}

	public function ihcoderdov_register_frontend_styles() {
		wp_enqueue_style(
            'ihcoderdov-owl-carousel',
            IHCODERDOV_URI . 'assets/css/owl.carousel.min.css',
            array(),
            IHCODERDOV_VERSION
        );

        wp_enqueue_style(
            'widgets.css',
            IHCODERDOV_URI . 'assets/css/widgets.css',
            array(),
            IHCODERDOV_VERSION
        );
	}



	//tynimac button functions end
   

	


	public function register_new_category($manager){
	   $manager->add_category('ihcoderdov',
			[
				'title' => __( 'Ihcoderdov', 'ihcoderdov' ),
			]);
	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'ihcoderdov' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'ihcoderdov' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ihcoderdov' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ihcoderdov' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'ihcoderdov' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ihcoderdov' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ihcoderdov' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'ihcoderdov' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'ihcoderdov' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function init_widgets() {

		//Register Carousel widget
		require_once( __DIR__ . '/widgets/slider.php' );
		Plugin::instance()->widgets_manager->register_widget_type( new \Slider() );
	}

}

Elementor_Ihcoderdov_Extension::instance();

// End Elementor Functions


