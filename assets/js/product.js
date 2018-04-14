var $ = jQuery;

function getDataAfterFilter(){
	var data = wcsp_product_single.product_variants;
	var options = wcsp_product_single.variant_option;
	var new_data = data;
	var count = 0;
	$.each(options, function(key, val){
		var filter_option = $('select[name="attribute_'+key+'"]').val();
		if(filter_option){
			count++;
			new_data = new_data.filter(function(el){
				return el.attributes['attribute_' + key] == filter_option;
			});
		}
	});
	if(count == 0)
		return [];	
	return new_data;

}

function listSellerItem(data){
	var list = '';
	if(data.length != 0){
		$.each(data, function(key, val){
		list += '<div class="wcsp-seller-item-product">\
				<div class="row">\
					<div class="col-sm-4">'+val.seller+'</div>\
					<div class="col-sm-4">'+val.price+'</div>\
					<div class="col-sm-4"><a class="button data-wcsp_add_cart" data-wcsp_add_cart="'+val.id+'">Add to Cart</a></div>\
				</div>\
			<div>';
		});
	}
	return list;
}

$(document).ready(function(){
	
	var seller_area = $('.wcsp-seller-list-wrapp');
	var product_lists = $('[data-product_variations]').data('product_variations');
	var target = $('.single_add_to_cart_button[type="submit"]');
	var current_variant = $('input[name="variation_id"]');

	seller_area.html(listSellerItem(getDataAfterFilter()));

	$('a.data-wcsp_add_cart').on('click', function(e){
		console.log('click add');
		$('input[name="variation_id"]').val($(this).data('wcsp_add_cart'));
		$('.single_add_to_cart_button').trigger('click');
	});

	$('select[data-attribute_name]').on('change', function(e){
		seller_area.html(listSellerItem(getDataAfterFilter()));
	});

});