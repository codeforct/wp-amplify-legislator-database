<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://codeforconnecticut.org
 * @since      1.0.0
 *
 * @package    Amplify_Legislators_Database
 * @subpackage Amplify_Legislators_Database/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Amplify_Legislators_Database
 * @subpackage Amplify_Legislators_Database/admin
 * @author     José Padilla <jose@codeforconnecticut.org>
 */
class Amplify_Legislators_Database_Admin {

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
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Amplify_Legislators_Database_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Amplify_Legislators_Database_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/amplify-legislators-database-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Amplify_Legislators_Database_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Amplify_Legislators_Database_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/amplify-legislators-database-admin.js', array( 'jquery' ), $this->version, false );

	}


	public function add_admin_page() {
		$page_title = 'Amplify';
		$menu_title = 'Amplify';
		$capability = 'manage_options';
		$menu_slug  = 'amplify-legislators-database';
		$function   = array( $this, 'load_admin_page_content' );
		add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function );

		add_submenu_page( $menu_slug, 'Legislators Database', 'Legislators Database', $capability, $menu_slug);
		add_submenu_page( $menu_slug, 'Settings', 'Settings', $capability, 'amplify-settings', $function);
	}

	public function load_admin_page_content() {
		require_once plugin_dir_path( __FILE__ ) . 'partials/amplify-legislators-database-admin-display.php';
	}

	public function handle_process_database_form() {
		$form_nonce = $_POST['amplify_process_database_form_nonce'];

		if ( isset( $form_nonce ) && wp_verify_nonce( $form_nonce, 'amplify_process_database_form_nonce' ) ) {

			$result = @file_get_contents("https://raw.githubusercontent.com/codeforct/legislator-database/master/data/latest.json");

			if ($result === FALSE) {
				$fallback_file_path = plugin_dir_path( __FILE__ ) . "data/fallback.json";
				$result = file_get_contents($fallback_file_path);
			}

			$obj = json_decode($result); //Turns the json into an object
			$res = $obj->data; //Takes the data part of the json

			//Sorts the list of law makers by Cac region
			usort($res, function($a, $b) {return strcmp($a->_cac, $b->_cac);});


			require_once plugin_dir_path( __FILE__ ) . 'partials/amplify-legislators-database-admin-table.php';
		} else {
			wp_die(
				__( 'Invalid nonce specified', $this->plugin_name ),
				__( 'Error', $this->plugin_name ),
				array(
					'response'  => 403,
					'back_link' => 'admin.php?page=' . $this->plugin_name,
				)
			);
		}
	}

	//Function for printing to Console and debugging lol
	public function console_log($output, $with_script_tags = true) {
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}
	//echo '<script>console.log('.$result.')</script>';
	// echo '<script>console.log("BEG")</script>';

}
