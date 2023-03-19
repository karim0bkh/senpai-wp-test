<?php
/**
 * theme features.
 *
 * This class defines all code necessary to run during the theme's activation.
 *
 * @since      1.0.0
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */
class Senpai_Wp_Test_Features {

    public function __construct(){
        $this->addSupport('title-tag')
             ->addSupport('custom-logo')
             ->addSupport('post-thumbnails')
             ->addSupport('customize-selective-refresh-widgets')
             ->addSupport('html5', [
                 'search-form',
                 'comment-form',
                 'comment-list',
                 'gallery',
                 'caption'
             ])
             ->addStyle('theme-styles',  get_stylesheet_uri())
             ->addCommentScript();
    }

	private function actionAfterSetup($function){
        add_action('after_setup_theme', function() use ($function) {
            $function();
        });
    }

	private function actionEnqueueScripts($function){
        add_action('wp_enqueue_scripts', function() use ($function){
            $function();
        });
    }

    public function addStyle($handle,  $src = '',  $deps = array(), $ver = false, $media = 'all'){
        $this->actionEnqueueScripts(function() use ($handle, $src, $deps, $ver, $media){
            wp_enqueue_style($handle,  $src,  $deps, $ver, $media);
        });
        return $this;
    }

    private function actionWidgetsInit($function){
        add_action('widgets_init', function() use ($function) {
            $function();
        });
    }

	public function addSupport($feature, $options = null){
        $this->actionAfterSetup(function() use ($feature, $options) {
            if ($options){
                add_theme_support($feature, $options);
            } else {
                add_theme_support($feature);
            }
        });
        return $this;
    }

    public function addWidget($id, $name){
        $this->actionWidgetsInit(function() use ($id, $name) {
            register_sidebar(
                array(
                    'name'          => esc_html__( $name, 'senpai-wp-test' ),
                    'id'            => $id,
                    'description'   => esc_html__( 'Add widgets here.', 'senpai-wp-test' ),
                    'before_widget' => '',
                    'after_widget'  => '',
                    'before_title'  => '',
                    'after_title'   => '',
                )
            );
        });
        return $this;
    }

    public function removeSupport($feature){
        $this->actionAfterSetup(function() use ($feature){
            remove_theme_support($feature);
        });
        return $this;
    }

	public function addImageSize($name, $width = 0, $height = 0, $crop = false){
        $this->actionAfterSetup(function() use ($name, $width, $height, $crop){
            add_image_size($name, $width, $height, $crop);
        });
        return $this;
    }

    public function removeImageSize($name){
        $this->actionAfterSetup(function() use ($name){
            remove_image_size($name);
        });
        return $this;
    }

	public function addCommentScript(){
        $this->actionEnqueueScripts(function(){
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }
        });
        return $this;
    }

	public function addNavMenus($locations = array()){
        $this->actionAfterSetup(function() use ($locations){
            register_nav_menus($locations);
        });
        return $this;
    }

    public function addNavMenu($location, $description){
        $this->actionAfterSetup(function() use ($location, $description){
            register_nav_menu($location, $description);
        });
        return $this;
    }

    public function removeNavMenu($location){
        $this->actionAfterSetup(function() use ($location){
            unregister_nav_menu($location);
        });
        return $this;
    }

}
