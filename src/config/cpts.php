<?php
function marmalade_cpts_register() {

	$cpts = array(
    new Marmalade\CPT('products','Product','Products'),
    new Marmalade\CPT('orders','Order','Orders', array('title'))
  );

  foreach($cpts as $cpt){
    $cpt->register_thyself();
  }
}

add_action('init', 'marmalade_cpts_register');