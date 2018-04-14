<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
/*
Plugin Name: Woocomerce Seller Price
Plugin URI: #
Description: Price Product per Seller
Author: ridolud
Version: dev-0.1
Author URI: #
*/

define('WCSP_PLUGIN_FILE_PATH',	__DIR__);
define('WCSP_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ));

require_once( WCSP_PLUGIN_FILE_PATH . '/include/wcsp-function-admin.php');
require_once( WCSP_PLUGIN_FILE_PATH . '/include/wcsp-function-save-product.php');
require_once( WCSP_PLUGIN_FILE_PATH . '/include/wcsp-function-role.php');
require_once( WCSP_PLUGIN_FILE_PATH . '/include/wcsp-function-single-product-page.php');

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );

// Include Assets
add_action('wp_enqueue_scripts', 'wcsp_include_assets');
function wcsp_include_assets() {
    wp_register_style( 'wcsp-product-page', WCSP_PLUGIN_DIR_URL . '/assets/css/product-page.css' );
    wp_enqueue_style( 'wcsp-product-page' );
}
