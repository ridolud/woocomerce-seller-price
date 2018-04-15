var $ = jQuery;

function listSellerItem(){
	var id_product = $('input[name="product_id"]').val();
	var seller_area = $('.wcsp-seller-list-wrapp');
	var params = {
		'action' : 'wcsp_get_item',
		'id_product' : id_product,
	}

	jQuery.post(wcsp_product_single.ajax_url, params, function(response) {
		var data = JSON.parse(response);
		var result = [];
		var list = '';
		$.each(data.variant_option, function(key, val){
			var filter_option = $('select[name="attribute_'+key+'"]').val();
			if(filter_option){
			console.log('before filter',data.data);
				result = data.data.filter(function(el){
					return el.attributes['attribute_' + key] == filter_option;
				});
			}
		});
		console.log('after filter', result);
		if(result.length != 0){
			$.each(result, function(key, val){
			console.log('item', val);
			list += '<div class="wcsp-seller-item-product">\
					<div class="row">\
						<div class="col-sm-4">'+val.seller+'</div>\
						<div class="col-sm-4">'+val.price+'</div>\
						<div class="col-sm-4"><a class="button data-wcsp_add_cart" data-wcsp_add_cart="'+val.id+'">Add to Cart</a></div>\
					</div>\
				<div>';
			});
		}
		seller_area.html(list);
	});
}

$(document).ready(function(){
	// Init.	
	listSellerItem();

	$('body').on('click', 'a.data-wcsp_add_cart', function(e){
		$('input[name="variation_id"]').val($(this).data('wcsp_add_cart'));
		$('.single_add_to_cart_button').trigger('click');
	});

	$('select[data-attribute_name]').on('change', function(e){
		listSellerItem();
	});

});