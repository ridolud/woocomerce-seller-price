<?php
/**
 * Register Product Type " Seller "
 * use this code for start register
 * {{ add_action( 'init', 'register_variant_seller_product_type' ); }}
 * {{ add_filter( 'product_type_selector', 'add_variant_seller_product' ); }}
 */

function register_variant_seller_product_type() {
	
	/**
	 * This should be in its own separate file.
	 */
	class WC_Product_Variant_Seller extends WC_Product_Simple {
		public function __construct( $product ) {
			$this->product_type = 'variant_seller';
			parent::__construct( $product );
		}
	}

}

function add_variant_seller_product( $types ){

	// Key should be exactly the same as in the class product_type parameter
	$types[ 'variant_seller' ] = __( 'Variant Seller' );
	return $types;

}

add_action( 'init', 'register_variant_seller_product_type' );
add_filter( 'product_type_selector', 'add_variant_seller_product' );