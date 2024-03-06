<?php
defined('ABSPATH') or die('No script kiddies please!');

function register_my_custom_endpoints() {
    register_rest_route('my-vue-plugin/v1', '/data/', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'my_custom_endpoint_callback',
    ));
}

add_action('rest_api_init', 'register_my_custom_endpoints');

function my_custom_endpoint_callback(WP_REST_Request $request) {
    // Your logic to fetch and return data
    return new WP_REST_Response(array('message' => 'Hello World'), 200);
}
?>
