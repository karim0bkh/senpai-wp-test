<?php

/**
 * The file that defines the API class
 *
 *
 * @link       https://senpai.codes
 * @since      1.0.0
 *
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 */

/**
 * The API class.
 *
 *
 * @since      1.0.0
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */
class Senpai_Wp_Test_API {

    private $namespace;

    private $version;

    public function __construct($namespace = 'senpai_api', $version = 'v1') {
        $this->namespace = $namespace;
        $this->version = $version;
    }

    public function register_endpoints(){
        /**
         * WP_REST_Server::READABLE = ‘GET’
         * WP_REST_Server::EDITABLE = ‘POST, PUT, PATCH’
         * WP_REST_Server::DELETABLE = ‘DELETE’
         * WP_REST_Server::ALLMETHODS = ‘GET, POST, PUT, PATCH, DELETE’
        */
        $namespace = $this->namespace . '/' . $this->version;

        //http://base/wp-json/senpai_api/v1/get-test
        register_rest_route( $namespace, '/get-test', array(
            'methods' => 'GET',
            'callback' => array($this,'get_test_data'),
            'permission_callback' => '__return_true'
        ));
        register_rest_route( $namespace, '/post-test', array(
            'methods' => 'POST',
            'callback' => array($this,'post_test_data'),
            'permission_callback' => '__return_true'
        ));
    }

    /**
     * @see https://developer.wordpress.org/reference/classes/wp_rest_request/
     */
    public function post_test_data(WP_REST_Request $request){
        $token = 'SENPAI-TEST';
        $headers = $request->get_headers();
        $auth_token = $headers['authorization'][0];

        if ( $token != $auth_token ) {
            return new WP_Error( '401', esc_html__( 'Not Authorized', 'senpai_wp_test' ), array( 'status' => 401 ) );
        }
     
        $respond = array(
            'success' => 1,
            'data' => array(),
            'error' => array()
        );
        return json_encode($respond);
    }


    /**
     * @see https://developer.wordpress.org/reference/classes/wp_rest_request/
     */
    public function get_test_data(WP_REST_Request $request){

        $respond = array(
            'success' => 1,
            'data' => array(),
            'error' => array()
        );
        return json_encode($respond);
    }

}