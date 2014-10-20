<?php
function register_session(){
  if(!session_id())
    session_start();
}
add_action('init','register_session');