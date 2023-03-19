<?php
/**
 * The Notices class.
 *
 * ```
 * 
 * $notices = new \Senpai_Wp_Test_Notices();
 * $notices->set('This is a notice','success',1,'all');
 * $notices->set('This is a notice','error',1,'all');
 * $notices->set('This is a notice','warning',1,'all');
 * $notices->set('This is a notice','info',1,'all');
 * $notices->set('This is a notice','default',1,'all');
 * 
 * 
 * ```
 *
 * @since      1.0.0
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */
class Senpai_Wp_Test_Notices {


    public function set($html, $type='default', $is_dismissible=1, $screen = 'all') {
        $generator = new \WP_SENPAI\Utils\RSG();
        $id = $generator->generate(5);
        $notice = array();
        $notice['screen'] = $screen;
        $notice['content'] = $html;
        if(in_array ( $type, array('default','success','error','warning','info') )){
            $notice['type'] = $type; 
        }else{
            $notice['type'] = 'default';
        }
        if(in_array ( $is_dismissible, array(0,1) )){
            $notice['is_dismissible'] = $is_dismissible;
        }else{
            $notice['is_dismissible'] = 1;
        }
        $notice['is_dismissible'] = $is_dismissible;
        
        $senpai_option = new \WP_SENPAI\Utils\JSON('senpai_notices');
        $senpai_option->set($id,$notice);
        $senpai_option->save();
    }

    public function get_all() {
        $current_screen = get_current_screen()->id;
        error_log('Active Screen: "' . $current_screen . '"');
        $class_error = 'notice-error';
        $class_success = 'notice-success';
        $class_warning = 'notice-warning';
        $class_info = 'notice-info';
        $class_is_dismissible = 'is-dismissible';
        $senpai_option = new \WP_SENPAI\Utils\JSON('senpai_notices');
        $all_notices = $senpai_option->get_all();
        error_log(print_r($all_notices,1));
        if(count($all_notices)){
            foreach ($all_notices as $key => $notice) {
                if($notice->is_dismissible){
                    $dismissible = $class_is_dismissible;
                }else{
                    $dismissible = '';
                }
                
                if($notice->screen == 'all'){
                    if($notice->type == 'success'){
                        $css_class = $class_success;
                    }else if($notice->type == 'error'){
                        $css_class = $class_error;
                    }else if($notice->type == 'warning'){
                        $css_class = $class_warning;
                    }else if($notice->type == 'info'){
                        $css_class = $class_info;
                    }else{
                        $css_class = '';
                    }
                    $this->render_notice($css_class,$dismissible,$notice->content ,$key);
                }else if($notice->screen == $current_screen){
                    if($notice->type == 'success'){
                        $css_class = $class_success;
                    }else if($notice->type == 'error'){
                        $css_class = $class_error;
                    }else if($notice->type == 'warning'){
                        $css_class = $class_warning;
                    }else{
                        $css_class = '';
                    }
                    $this->render_notice($css_class,$dismissible,$notice->content ,$key);
                }
            }
        }
    }

    public function dissmiss() {
        $nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'senpai-ajax-notice-nonce' ) ){
			$respond = array(
				'success' => 0,
				'msg'=>'something went wrong'
			);
			wp_send_json($respond);
		}
		$id = $_POST['id'];
        $senpai_option = new \WP_SENPAI\Utils\JSON('senpai_notices');
        $senpai_option->remove($id);
        $senpai_option->save();
        $respond = array(
            'success' => 1,
            'msg'=>'Notice dissmissed'
        );
        wp_send_json($respond);
    }

    public function reset(){
        $senpai_option = new \WP_SENPAI\Utils\JSON('senpai_notices');
        $senpai_option->reset();
    }

    private function render_notice($css_class,$class_is_dismissible,$notice_content,$id){
        $classes = 'notice senpai-notice ' . $css_class;
        if($class_is_dismissible != ''){
            $classes .= ' ' . $class_is_dismissible; 
        }
        include THEME_DIR . '/admin/partials/senpai-wp-test-notice-display.php';
    }
}