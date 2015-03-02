<?php
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_order',
    'title' => 'Order',
    'fields' => array (
      array (
        'key' => 'field_54456fc3da99f',
        'label' => 'Shipping Info',
        'name' => 'shipping_info',
        'type' => 'textarea',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'formatting' => 'none',
      ),
      array (
        'key' => 'field_54f45f4fbbcf4',
        'label' => 'Line Items Readable',
        'name' => 'line_items_readable',
        'type' => 'textarea',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'formatting' => 'none',
      ),
      array (
        'key' => 'field_54458ff12376d',
        'label' => 'Total Price',
        'name' => 'total_price',
        'type' => 'number',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'min' => '',
        'max' => '',
        'step' => '',
      ),
      array (
        'key' => 'field_54458bcb82a28',
        'label' => 'Line Items Encrypted',
        'name' => 'line_items',
        'type' => 'textarea',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'formatting' => 'none',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'orders',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}
