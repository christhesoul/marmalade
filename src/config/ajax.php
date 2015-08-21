<?php
add_action('wp_head','marmalade_ajaxurl');

function marmalade_ajaxurl() { ?>
  <script type="text/javascript">
  var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
  </script>
<?php }