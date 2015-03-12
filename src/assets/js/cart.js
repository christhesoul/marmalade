update_carts = function(cart){
  $('.js-marmalade-mini-cart').html(cart.quantity + ' items, ' + cart.price);
  $('.js-marmalade-cart').find('.marmalade-total-price span').html(parseFloat(cart.price).toFixed(2))
}

$('document').ready(function(){

  $('body').on('click', '.marmalade-add-to-cart', function(){
    product_id = parseInt($(this).data('product'));
    data = { 'action': 'marmalade_add_to_cart', 'product': product_id };
    var that = $(this);
    jQuery.post(ajaxurl, data, function(response) {
      r = JSON.parse(response);
      if(r.status == 'ok'){
        update_carts(r.cart);
        that.addClass('btn-success').html(r.message);
      } else {
        that.addClass('btn-danger').html(r.message);
      }
    });
    return false;
  });

  $('body').on('click', '.marmalade-remove-from-cart', function(){
    product_id = parseInt($(this).data('product'));
    data = { 'action': 'marmalade_remove_from_cart', 'product': product_id };
    var that = $(this);
    jQuery.post(ajaxurl, data, function(response) {
      r = JSON.parse(response);
      if(r.status == 'ok'){
        update_carts(r.cart);
        $('.marmalade-remove-' + product_id).remove();
      } else {
        $('.marmalade-remove-' + product_id).remove();
      }
    });
    return false;
  });

  $('body').on('click', '.marmalade-add-shipping', function(){
    shipping_cost = parseFloat($(this).data('amount')).toFixed(2);
    data = { 'action': 'marmalade_add_shipping', 'shipping_cost': shipping_cost };
    var that = $(this);
    jQuery.post(ajaxurl, data, function(response) {
      r = JSON.parse(response);
      if(r.status == 'ok'){
        update_carts(r.cart);
        $('.marmalade-shipping-options a').removeClass('current-shipping');
        that.addClass('current-shipping');
      } else {
        alert('Something went wrong.')
      }
    });
    return false;
  });
});
