<?php
/**
 * Fired during theme activation.
 *
 * This class defines all code necessary to run during the theme's activation.
 *
 * @since      1.0.0
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */
class Senpai_Wp_Test_Activator {

	/**
	 * Global Logic run while activating the theme
	 *
	 * ```
	 * Senpai_Wp_Test_Activator::activate();
	 * ```
	 *
	 * @author	 Amine Safsafi
	 * @return void
	 */
	public static function activate() {

	}

	/**
	 * Initiate System required directories
	 * 
	 * ```
	 * Senpai_Wp_Test_Activator::init_dir();
	 * ```
	 * 
	 * @link https://developer.wordpress.org/reference/functions/wp_mkdir_p/
	 * 
	 * @author Amine Safsafi
	 * @return void
	 */
	public static function init_dir() {
		$upload = wp_upload_dir();
		$upload_dir_base = $upload['basedir'];

		/* $upload_dir = $upload_dir_base . '/example';
		if (! is_dir($upload_dir)) {
		   mkdir( $upload_dir, 0755 );
		   $f = fopen( $upload_dir . "/.htaccess", "a+");
		   fwrite($f, "deny from all");
		   fclose($f);
		} */
	}

	/**
	 * Initiate System required cron jobs
	 * 
	 * ```
	 * Senpai_Wp_Test_Activator::init_cron();
	 * ```
	 * 
	 * @link https://developer.wordpress.org/reference/functions/wp_schedule_event/
	 * 
	 * @author Amine Safsafi
	 * @return void
	 */
	public static function init_cron() {

	}

	/**
	 * Initiate System required roles
	 * 
	 * ```
	 * Senpai_Wp_Test_Activator::init_roles();
	 * ```
	 * 
	 * @link https://developer.wordpress.org/reference/functions/add_role/
	 * @author Amine Safsafi
	 * @return void
	 */
	public static function init_roles() {

	}

	/**
	 * Initiate System required database tables
	 * 
	 * ```
	 * Senpai_Wp_Test_Activator::init_database_tables();
	 * ```
	 * 
	 * @link https://developer.wordpress.org/reference/functions/maybe_create_table/
	 * @link https://developer.wordpress.org/reference/functions/wpdb/
	 * @link https://developer.wordpress.org/reference/functions/get_charset_collate/
	 * @link https://developer.wordpress.org/reference/functions/require_once/
	 * @link https://developer.wordpress.org/reference/functions/abspath/
	 * 
	 * @author Amine Safsafi
	 * @return void
	 */
	public static function init_database_tables(){
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		// Include Upgrade Script
		//require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		$table_name = $wpdb->prefix . 'custom_entries';

		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			$sql = "CREATE TABLE $table_name (
				id INT NOT NULL AUTO_INCREMENT,
				name VARCHAR(255),
				email VARCHAR(255),
				phone VARCHAR(15),
				message TEXT,
				PRIMARY KEY (id)
			);";
	
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}



		/* $example_table_name = $wpdb->prefix . "senpai_examples";
		$example_sql = "CREATE TABLE $example_table_name (
			id mediumint(11) NOT NULL AUTO_INCREMENT,
			data varchar(40) NOT NULL,
			PRIMARY KEY  (id)
		  ) $charset_collate;";
		maybe_create_table( $example_table_name, $example_sql ); */
	}

}
