<?php
/**
 * Single Product Page Customize
 * Use woocommerce's hook [woocommerce_before_add_to_cart_button].
 * <div class="wcsp-seller-item-product">
			<div class="row">
				<div class="col-sm-4">Seller 1</div>
				<div class="col-sm-4">Rp 230.000</div>
				<div class="col-sm-4"><button class="button">Add to Cart</button></div>
			</div>
		</div>
 */

function wcsp_action_woocommerce_before_add_to_cart_button() { 
	global $product;
	$variant_data = [];
	if ($product->is_type( 'variable' )) {
	    $available_variations = $product->get_available_variations();
	    foreach ($available_variations as $key => $value) 
	    { 
	    	$id_seller = get_post_meta($value['variation_id'], '_seller_id', true);
	    	$data_seller = get_userdata($id_seller);
	    	array_push($variant_data,[ 
	    		'seller' => $data_seller->display_name, 
	    		'price' => $value['display_price'],
	    		'id' => $value['variation_id'],
	    		'attributes' => $value['attributes'],
	    	]);
	    }

	    $wcsp_product_single = array(
  			'ajax_url' => admin_url( 'admin-ajax.php' ),
  			'variant_option' => $product->get_variation_attributes(),
  			'product_variants' => $variant_data,
		);

	    wp_register_script( 'wcsp-product', WCSP_PLUGIN_DIR_URL . '/assets/js/product.js', array('jquery'), true);
		wp_localize_script( 'wcsp-product', 'wcsp_product_single', $wcsp_product_single );
		wp_enqueue_script( 'wcsp-product' );

	}
	echo '<div class="wcsp-seller-list-wrapp">';
	echo '</div>';
}; 
             
add_action( 'woocommerce_before_add_to_cart_button', 'wcsp_action_woocommerce_before_add_to_cart_button', 10, 0 ); 
