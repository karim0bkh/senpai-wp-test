<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this theme
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */
class Senpai_Wp_Test_i18n {


	/**
	 * Load the theme text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_theme_textdomain() {

		load_theme_textdomain(
			'senpai-wp-test',
			false,
			THEME_DIR . '/languages/'
		);

	}



}
