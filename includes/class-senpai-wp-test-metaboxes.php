<?php
/**
 * The MetaBoxes class.
 *
 *
 * @since      1.0.0
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */
class Senpai_Wp_Test_MetaBoxes {

    private $prefix;

    public function __construct($prefix = 'senpai_metabox_') {
        $this->prefix = $prefix;
    }

    public function register_metaboxes(){
        /**
         * @see https://developer.wordpress.org/reference/functions/add_meta_box/
         */
        $screens = array('page' );
        add_meta_box(
            $this->prefix . 'test',
            __( 'Test', 'senpai-wp-test' ),
            array($this,'test_meta_box_render'),
            $screens
        );
    }

    public function test_meta_box_render( $post ){

        include THEME_DIR . '/admin/partials/senpai-metabox-display.php';
    }


}