<?php
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_products',
    'title' => 'Products',
    'fields' => array (
      array (
        'key' => 'field_5441884fa70f7',
        'label' => 'Price',
        'name' => 'price',
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
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'products',
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