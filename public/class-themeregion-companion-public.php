<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://themeregion.com/
 * @since      1.0.0
 *
 * @package    Themeregion_Companion
 * @subpackage Themeregion_Companion/public
 */

defined( 'TRC_PUBLIC_PARTIALS' )  or define( 'TRC_PUBLIC_PARTIALS', dirname( __FILE__ ) . '/partials/'     );
defined( 'TRC_PUBLIC_INC'      )  or define( 'TRC_PUBLIC_INC',      dirname( __FILE__ ) . '/partials/inc/' );

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Themeregion_Companion
 * @subpackage Themeregion_Companion/public
 * @author     ThemeRegion Team <support@themeregion.com>
 */
class Themeregion_Companion_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_theme_public_includes();

	}

	public function load_theme_public_includes() {

		require TRC_PUBLIC_INC . 'widgets/tr.social.php';
		require TRC_PUBLIC_INC . 'widgets/tr.image.title.php';
		require TRC_PUBLIC_INC . 'widgets/tr.mailchimp.php';
		require TRC_PUBLIC_INC . 'widgets/tr.recent.posts.widget.php';


		require TRC_PUBLIC_INC . 'tr.postlike.php';
		require TRC_PUBLIC_INC . 'tr.breadcrumb.php';
		require TRC_PUBLIC_INC . 'tr.postviews.php';
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/themeregion-companion-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/themeregion-companion-public.js', array( 'jquery' ), $this->version, false );

	}

}
