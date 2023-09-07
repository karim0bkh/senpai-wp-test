<?php
/**
 * The admin-specific functionality of the theme.
 *
 * Defines the theme name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/admin
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */
class Senpai_Wp_Test_Admin {

	/**
	 * The ID of this theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $senpai_wp_test    The ID of this theme.
	 */
	private $senpai_wp_test;

	/**
	 * The version of this theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this theme.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $senpai_wp_test       The name of this theme.
	 * @param      string    $version    The version of this theme.
	 */
	public function __construct( $senpai_wp_test, $version ) {

		$this->senpai_wp_test = $senpai_wp_test;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'senpai_wp_test_admin_loader_css', THEME_URI . '/admin/dist/main/senpai-wp-test-loader.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'senpai_wp_test_admin_loader_js', THEME_URI . '/admin/dist/main/senpai-wp-test-loader.js', array('wp-i18n','jquery'), $this->version, false );
		wp_enqueue_script( 'senpai_wp_test_admin_setting_js', THEME_URI . '/admin/dist/main/senpai-wp-test-setting.js', array('senpai_wp_test_admin_loader_js'), $this->version, false );
	
		wp_enqueue_script( 'senpai_notice_ajax', THEME_URI . '/admin/dist/main/senpai-wp-test-notice.js', array('senpai_wp_test_admin_loader_js') );
		wp_localize_script( 'senpai_notice_ajax', 'senpai_notice_ajax_params', array(
			'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
			'nonce' => wp_create_nonce('senpai-ajax-notice-nonce')
		) );
	
	}

	function custom_entries_admin_menu() {
		add_menu_page(
			'Custom Entries',
			'Custom Entries',
			'manage_options',
			'custom-entries',
			'custom_entries_page'
		);
	}

	function custom_entries_page() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'custom_entries';
		$entries = $wpdb->get_results("SELECT * FROM $table_name");
	
		echo '<div class="wrap">';
		echo '<h2>Custom Entries</h2>';
		echo '<table class="wp-list-table widefat fixed striped">';
		echo '<thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Message</th></tr></thead>';
		echo '<tbody>';
	
		foreach ($entries as $entry) {
			echo '<tr>';
			echo '<td>' . esc_html($entry->name) . '</td>';
			echo '<td>' . esc_html($entry->email) . '</td>';
			echo '<td>' . esc_html($entry->phone) . '</td>';
			echo '<td>' . esc_html($entry->message) . '</td>';
			echo '</tr>';
		}
	
		echo '</tbody></table>';
		echo '</div>';
	}
	

}
