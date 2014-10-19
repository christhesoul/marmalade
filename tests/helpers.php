<?php
function get_field($name, $id) {
  return 100;
}

function get_post($id) {
  if($id == 13){
    return false;
  } else {
    $object = new stdClass();
    $object->post_title = 'Widget';
    return $object;
  }
}