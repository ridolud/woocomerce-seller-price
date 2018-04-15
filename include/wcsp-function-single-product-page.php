<?php
/**
 * Single Product Page Customize
 * Use woocommerce's hook [woocommerce_before_add_to_cart_button].
 */

function wcsp_action_woocommerce_before_add_to_cart_button() { 

	$wcsp_product_single = array(
  			'ajax_url' => admin_url( 'admin-ajax.php' ),
	);

    wp_register_script( 'wcsp-product', WCSP_PLUGIN_DIR_URL . '/assets/js/product.js', array('jquery'), true);
	wp_localize_script( 'wcsp-product', 'wcsp_product_single', $wcsp_product_single );
	wp_enqueue_script( 'wcsp-product' );

	echo '<div class="wcsp-seller-list-wrapp">';
	echo '</div>';

}; 
             
add_action( 'woocommerce_before_add_to_cart_button', 'wcsp_action_woocommerce_before_add_to_cart_button', 10, 0 ); 

function wcsp_ajax_get_variant_product(){
	
	$product = wc_get_product($_POST['id_product']);

	$variant_data = array();
	if ($product->is_type( 'variable' )) {
	    $available_variations = $product->get_available_variations();
	    foreach ($available_variations as $key => $value) 
	    { 
	    	$id_seller = get_post_meta($value['variation_id'], '_seller_id', true);
	    	$data_seller = get_userdata($id_seller);
	    	$product_class = wc_get_product($value['variation_id']);
	    	
	    	if($product_class->get_stock_quantity()){
		    	array_push($variant_data,[ 
		    		'seller' => $data_seller->display_name, 
		    		'price' => $value['display_price'],
		    		'id' => $value['variation_id'],
		    		'attributes' => $value['attributes'],
		    	]);
	    	}
	    }
	}
	echo json_encode([ 'data' => $variant_data, 'variant_option' => $product->get_variation_attributes()]);
	die();
}

add_action('wp_ajax_nopriv_wcsp_get_item', 'wcsp_ajax_get_variant_product');
add_action('wp_ajax_wcsp_get_item', 'wcsp_ajax_get_variant_product');
