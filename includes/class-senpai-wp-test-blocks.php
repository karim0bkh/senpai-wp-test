<?php

/**
 * The file that defines the Blocks class
 *
 *
 * @link       https://senpai.codes
 * @since      1.0.0
 *
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 */

/**
 * The Blocks class.
 *
 * @see https://developer.wordpress.org/block-editor/getting-started/create-block/
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/
 * @since      1.0.0
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */
class Senpai_Wp_Test_Blocks {

    private $blocks_base_uri;
    private $blocks_base_dir;
    private $block_domain;

    public function __construct($domain = 'senpai-wp-test') {
        $this->blocks_base_uri = THEME_URI . '/blocks/';
        $this->blocks_base_dir = THEME_DIR . '/blocks/';
        $this->block_domain = $domain;
    }

    public function custom_blocks_cat($categories, $post){
        return array_merge(
            $categories,
            array(
                array(
                    'slug' => 'senpai-blocks',
                    'title' => __( 'Senpai Blocks', $this->block_domain ),
                    'icon'  => 'wordpress',
                ),
            )
        );
    }

    public function load_blocks(){
        //$this->load_block('senpai-test');

    }

    public function load_block($name){
        $script_asset_path = $this->blocks_base_dir . $name . "/build/index.asset.php";
        $index_js     =  $name . '/build/index.js';
        $editor_css   =  $name . '/build/index.css';
        $style_css    =  $name . '/build/style-index.css';

        if ( ! file_exists( $script_asset_path ) ) {
            throw new Error(
                "You need to run `npm start` or `npm run build` for the \"wp-senpai-blocks/$name\" block first."
            );
        }
        $script_asset = require( $script_asset_path );
        
        wp_register_script(
            "wp-senpai-blocks-$name-block-editor",
            $this->blocks_base_uri . $index_js,
            $script_asset['dependencies'],
            null
        );
        wp_set_script_translations( "wp-senpai-blocks-$name-block-editor", $this->block_domain );
    
        wp_register_style(
            "wp-senpai-blocks-$name-block-editor",
            $this->blocks_base_uri . $editor_css,
            array(),
            null
        );
    
        wp_register_style(
            "wp-senpai-blocks-$name-block",
            $this->blocks_base_uri . $style_css,
            array(),
            null
        );
    
        register_block_type( "wp-senpai-blocks/$name", array(
            'editor_script' => "wp-senpai-blocks-$name-block-editor",
            'editor_style'  => "wp-senpai-blocks-$name-block-editor",
            'style'         => "wp-senpai-blocks-$name-block",
        ) );

    }

}