<?php

defined('ABSPATH' ) or die('No script kiddies please!' );

/*Custom post type*/
add_action( 'init', function(){
	
	$labels = array(
		'name'               	=> __( 'Projects' ),
		'singular_name'      	=> __( 'Project' ),
		'add_new'            	=> __( 'New project' ),
		'add_new_item'       	=> __( 'New project' ),
		'edit_item'          	=> __( 'Edit project' ),
		'view_item'          	=> __( 'View project' ),
		'search_items'       	=> __( 'Search project' ),
		'not_found'          	=> __( 'No results have been found' ),
	);
	
	register_post_type('project', array(
		'public' => true,
		'labels' => $labels,
		'has_archive' => true,     	
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
	));
  
});	
