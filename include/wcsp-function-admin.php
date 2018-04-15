<?php
/**
 * Add field in variant product option. 
 */

// Add Variation Settings
add_action( 'woocommerce_product_after_variable_attributes', 'WCSP_variation_settings_fields', 1, 3 );
function WCSP_variation_settings_fields( $loop, $variation_data, $variation )
{
	// Input seller
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_seller_id[' . $variation->ID . ']', 
			'label'       => __( 'Select Seller', 'woocommerce' ), 
			'placeholder' => 'Select Seller',
			'desc_tip'    => 'true',
			'description' => __( 'Select seller for price variant per seller .', 'woocommerce' ),
			'value'       => get_post_meta( $variation->ID, '_seller_id', true )
		)
	);
}

// Load Value
add_action( 'woocommerce_product_after_variable_attributes_js', 'WCP_variable_fields_js' );
function WCP_variable_fields_js() {
	$wcsp_variant_seller = woocommerce_wp_textarea_input( 
	    array( 
	      'id'          => '_seller_id[ + loop + ]', 
	      'label'       => __( 'My Textarea', 'woocommerce' ), 
	      'placeholder' => '', 
	      'description' => __( 'Enter the custom value here.', 'woocommerce' ),
	      'value'       => '',
	    )
	);
}


