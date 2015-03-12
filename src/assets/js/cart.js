update_mini_cart = function(cart){
  $('.js-marmalade-mini-cart').html(cart.quantity + ' items, ' + cart.price);
}

$('document').ready(function(){

  $('body').on('click', '.marmalade-add-to-cart', function(){
    product_id = parseInt($(this).data('product'));
    data = { 'action': 'marmalade_add_to_cart', 'product': product_id };
    var that = $(this);
    jQuery.post(ajaxurl, data, function(response) {
      r = JSON.parse(response);
      if(r.status == 'ok'){
        update_mini_cart(r.cart);
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
        update_mini_cart(r.cart);
        console.log(product_id);
        $('.marmalade-remove-' . product_id).remove();
      } else {
        $('.marmalade-remove-' . product_id).remove();
      }
    });
    return false;
  });
});
