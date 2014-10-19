<?php
namespace Marmalade;

class Order {
  
  function __construct($post) {
    if(!wp_verify_nonce($post['new_order_nonce'], 'create_order')) {
      die('Something suspicious is happening.');
    } else {
      $this->create();
    }
  }
  
  private function create() {
    $uniqid = uniqid();
    $order_id = wp_insert_post(
      array(
        'post_title' => $uniqid,
        'post_type' => 'order',
        'post_name' => $uniqid,
        'post_status' => 'publish'
      )
    );
    wp_redirect(get_permalink($order_id));
    exit;
  }
  
}