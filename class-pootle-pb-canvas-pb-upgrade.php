<?php

class Pootle_PB_Canvas_PB_Upgrade{

	/**
	 * Pootle_PB_Canvas_PB_Upgrade Instance of main plugin class.
	 *
	 * @var 	object Pootle_PB_Canvas_PB_Upgrade
	 * @access  private
	 * @since 	0.1.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   0.1.0
	 */
	public static $token;
	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   0.1.0
	 */
	public static $version;

	/**
	 * Pootle Page Builder Canvas Page Builder Upgrade plugin directory URL.
	 *
	 * @var 	string Plugin directory
	 * @access  private
	 * @since 	0.1.0
	 */
	public static $url;

	/**
	 * Pootle Page Builder Canvas Page Builder Upgrade plugin directory Path.
	 *
	 * @var 	string Plugin directory
	 * @access  private
	 * @since 	0.1.0
	 */
	public static $path;

	/**
	 * Main Pootle Page Builder Canvas Page Builder Upgrade Instance
	 *
	 * Ensures only one instance of Storefront_Extension_Boilerplate is loaded or can be loaded.
	 *
	 * @since 0.1.0
	 * @return Pootle_PB_Canvas_PB_Upgrade instance
	 */
	public static function instance() {
		if ( null == self::$_instance ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Constructor function.
	 * @access  private
	 * @since   0.1.0
	 */
	private function __construct() {

		self::$token   =   'pootle-pb-canvas-pb-upgrade';
		self::$url     =   plugin_dir_url( __FILE__ );
		self::$path    =   plugin_dir_path( __FILE__ );
		self::$version =   '0.1.0';

		add_action( 'init', array( $this, 'init' ) );
	} // End __construct()

	/**
	 * Initiates the plugin
	 * @action init
	 * @since 0.1.0
	 */
	public function init() {

		if ( class_exists( 'Pootle_Page_Builder' ) ) {

			//Add the required hooks
			$this->add_hooks();

			// Pootlepress API Manager
			/** Including PootlePress_API_Manager class */
			require_once( plugin_dir_path( __FILE__ ) . 'pp-api/class-pp-api-manager.php' );
			/** Instantiating PootlePress_API_Manager */
			new PootlePress_API_Manager( self::$token, 'Pootle Page Builder Canvas Page Builder Upgrade', self::$version, __FILE__, self::$token );
		}
	} // End init()

	/**
	 * Adds the hooks required
	 * @since 0.1.0
	 */
	private function add_hooks() {

		//Adding front end JS and CSS in /assets folder
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

	} // End add_filters()

	/**
	 * Adds front end stylesheet and js
	 * @since 0.1.0
	 */
	public function enqueue() {
		$token = self::$token;
		$url = self::$url;

		wp_enqueue_style( $token . '-css', $url . '/assets/front-end.css' );
		wp_enqueue_script( $token . '-js', $url . '/assets/front-end.js', array( 'jquery' ) );
	} // End enqueue()

}