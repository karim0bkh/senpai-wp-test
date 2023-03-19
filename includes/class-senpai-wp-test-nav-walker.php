<?php
/**
 * theme features.
 *
 * This class defines all code necessary to display Custom Nav Walker.
 * ```
 * wp_nav_menu( array(
 *   'theme_location'    => 'primary-menu',
 *   'depth'             => 1,
 *   'container'         => 'div',
 *   'container_class'   => '',
 *   'container_id'      => '',
 *   'menu_class'        => '',
 *   'walker'            => new Senpai_Wp_Test_Navwalker(),
 * ));
 * ```
 *
 * @since      1.0.0
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */
// Check if Class Exists.
if ( ! class_exists( 'Senpai_Wp_Test_Navwalker' ) ) :
class Senpai_Wp_Test_Navwalker extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
        $object = $item->object;
        $type = $item->type;
        $title = $item->title;
        $description = $item->description;
        $permalink = $item->url;
        $menu_classes = $args->menu_class;

        $active = '';
        $output .= "<li>";
        $output .= "<a href='$permalink'>$title</a>";
    }
    function end_el(&$output, $item, $depth=0, $args=array()) {
        $output .= "</li>";
    }


    function start_lvl(&$output, $depth=0, $args=array()) {
        $output .= "<ul>";
    }
 

    function end_lvl(&$output, $depth=0, $args=array()) {
        $output .= "</ul>";
    }
}

endif;