<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.crestinfosystems.com/
 * @since      1.0.0
 *
 * @package    Crud_Operation
 * @subpackage Crud_Operation/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Crud_Operation
 * @subpackage Crud_Operation/includes
 * @author     Crest Infosystems <chirag.parmar@crestinfosystems.com>
 */
class Crud_Operation_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		global $wpdb;
	    $table_name = $wpdb->prefix . 'custom_email';
		$sql = "DROP TABLE IF EXISTS $table_name;";
    	$wpdb->query($sql);

	}

}
