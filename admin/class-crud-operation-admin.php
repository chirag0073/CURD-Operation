<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.crestinfosystems.com/
 * @since      1.0.0
 *
 * @package    Crud_Operation
 * @subpackage Crud_Operation/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Crud_Operation
 * @subpackage Crud_Operation/admin
 * @author     Crest Infosystems <chirag.parmar@crestinfosystems.com>
 */
class Crud_Operation_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		 * defined in Crud_Operation_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Crud_Operation_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/crud-operation-admin.css', array(), $this->version, 'all' );

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
		 * defined in Crud_Operation_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Crud_Operation_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/crud-operation-admin.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, "admin_curd_ajax", array('ajaxurl' => admin_url( 'admin-ajax.php' )) );

	}

	/**
	 * Register the menu page for the admin area.
	 *
	 * @since    1.0.0
	 */

	public function custom_email_admin_menu() {

		$page_title = 'E-mail Menu';
		$menu_title = 'E-mail Menu';
		$capability = 'manage_options';
		$menu_slug  = 'email-menu';
		$function   = 'custom_email_menu';
		$icon_url   = 'dashicons-media-code';
		$position   = 20;

		add_menu_page( $page_title, $menu_title, $capability, $menu_slug, array($this, $function), $icon_url, $position );

	}

	public function custom_email_menu(){
		// echo "Silence is a golden";
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/crud-operation-admin-display.php';
	}

	//Function for update the record ajax callback
	public function crud_delete_record()
	{
		//print_r($_POST);
		global $wpdb;
    	$id = $_POST['id'];
		$table_name = $wpdb->prefix . 'custom_email';
		$result = $wpdb->delete( $table_name, array( 'id' => $id ) );
		echo json_encode(array('success' => true, 'result' => $result));
		die;
	}

	//Function for delete the record ajax callback
	public function crud_update_record()
	{
		//print_r($_POST);
		global $wpdb;
    	$id = $_POST['id'];
    	$email = $_POST['email'];
		$table_name = $wpdb->prefix . 'custom_email';
		$result = $wpdb->update( $table_name, array( 'email' => $email), array( 'id' => $id ));
		echo json_encode(array('success' => true, 'result' => $result));
		die;
	}

}