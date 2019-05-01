<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.crestinfosystems.com/
 * @since      1.0.0
 *
 * @package    Crud_Operation
 * @subpackage Crud_Operation/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Crud_Operation
 * @subpackage Crud_Operation/includes
 * @author     Crest Infosystems <chirag.parmar@crestinfosystems.com>
 */
class Crud_Operation_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		global $wpdb;
		$table_name = $wpdb->prefix . 'custom_email';
	    $charset_collate = $wpdb->get_charset_collate();

		// check if it is a multisite network
		if (is_multisite()) {
			// check if the plugin has been activated on the network or on a single site
			if (is_plugin_active_for_network(__FILE__)) {
				// get ids of all sites
				$blogids = $wpdb->get_col(“SELECT blog_id FROM $wpdb->blogs”);
				foreach ($blogids as $blog_id) {
					switch_to_blog($blog_id);
					// create tables for each site
					if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {
				        $sql = "CREATE TABLE $table_name (
				                        id mediumint(9) NOT NULL AUTO_INCREMENT,
				                        email varchar(250),
				                        PRIMARY KEY  (id)
				                        ) $charset_collate;";

				        $results = $wpdb->query($sql);
				    }
					restore_current_blog();
				}
			}

			else

			{
				// activated on a single site, in a multi-site
			    if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {
			        $sql = "CREATE TABLE $table_name (
			                        id mediumint(9) NOT NULL AUTO_INCREMENT,
			                        email varchar(250),
			                        PRIMARY KEY  (id)
			                        ) $charset_collate;";

			        $results = $wpdb->query($sql);
			    }

			}

		}

		else

		{
			// activated on a single site
		    if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {
		        $sql = "CREATE TABLE $table_name (
		                        id mediumint(9) NOT NULL AUTO_INCREMENT,
		                        email varchar(250),
		                        PRIMARY KEY  (id)
		                        ) $charset_collate;";

		        $results = $wpdb->query($sql);
		    }
		}

		/*global $wpdb;
	    $table_name = $wpdb->prefix . 'custom_email';
	    $charset_collate = $wpdb->get_charset_collate();

	    if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {
	        $sql = "CREATE TABLE $table_name (
	                        id mediumint(9) NOT NULL AUTO_INCREMENT,
	                        email varchar(250),
	                        PRIMARY KEY  (id)
	                        ) $charset_collate;";

	        $results = $wpdb->query($sql);
	    }*/

	}

}
