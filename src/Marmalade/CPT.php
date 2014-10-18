<?php
namespace Marmalade;

class CPT {

  public $namespace;
  public $singular;
  public $plural;
  public $supports;
  public $map_meta_cap = true;
  public $managerify = false;

  public function __construct($namespace, $singular, $plural, $supports = array('title', 'editor','excerpt','thumbnail'))
  {
    $this->namespace = $namespace;
    $this->singular = $singular;
    $this->plural = $plural;
    $this->supports = $supports;
  }

  public function build_labels()
  {
    return array(
      'name' => _x($this->plural, 'post type general name'),
      'singular_name' => _x($this->singular, 'post type singular name'),
      'add_new' => _x('Add New', $this->namespace),
      'add_new_item' => __('Add New '.$this->singular),
      'edit_item' => __('Edit '.$this->singular),
      'new_item' => __('New '.$this->singular),
      'view_item' => __('View '.$this->singular),
      'search_items' => __('Search '.$this->plural),
      'not_found' =>  __('No '.$this->plural.' Found'),
      'not_found_in_trash' => __('No '.$this->plural.' Found in Trash'),
      'parent_item_colon' => ''
	  );
  }

  public function build_args()
  {
    $basic = array(
      'labels' => $this->build_labels(),
      'public' => true,
      'show_ui' => true,
      'publicly_queryable' => true,
      'query_var' => true,
      'hierarchical' => false,
      'rewrite' => true,
      'supports' => $this->supports,
      'capability_type' => $this->capability_type(),
    );
    $manager = array(
      'map_meta_cap' => $this->map_meta_cap()
    );
    if(!$this->managerify){
      return $basic;
    } else {
      return array_merge($basic, $manager);
    }
  }

  public function make_manager()
  {
    $this->managerify = true;
    add_role(
      $this->namespace . '_manager',
      $this->plural . ' Manager',
      array(
        'read' => true,
        'edit_posts' => false,
        'delete_posts' => false,
        'publish_posts' => false,
        'upload_files' => true,
      )
    );
    $this->assign_roles();
  }

  public function register_thyself()
  {
    register_post_type($this->namespace, $this->build_args() );
  }

  private function assign_roles()
  {
    $roles = array($this->namespace . '_manager','editor','administrator');
    foreach($roles as $the_role) {
      $role = get_role($the_role);
      $role->add_cap( 'read' );
      $role->add_cap( 'read_' . strtolower($this->singular));
      $role->add_cap( 'read_private_' . strtolower($this->plural));
      $role->add_cap( 'edit_' . strtolower($this->plural));
      $role->add_cap( 'edit_' . strtolower($this->singular));
      $role->add_cap( 'edit_published_' . strtolower($this->plural));
      $role->add_cap( 'publish_' . strtolower($this->plural));
      $role->add_cap( 'delete_private_' . strtolower($this->plural));
      $role->add_cap( 'delete_published_' . strtolower($this->plural));
      if(in_array($the_role,array('editor','administrator'))){
        $role->add_cap( 'edit_others_' . strtolower($this->plural));
        $role->add_cap( 'delete_others_' . strtolower($this->plural));
      }
    }
  }

  private function capability_type()
  {
    if($this->managerify){
      return array(strtolower($this->singular),strtolower($this->plural));
    } else {
      return 'post';
    }
  }

  private function map_meta_cap()
  {
    return $this->managerify ? true : false;
  }
}