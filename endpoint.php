<?php

defined('ABSPATH' ) or die('No script kiddies please!' );


add_action( 'rest_api_init', function(){
	
	register_rest_route( 'custom-projects', 'search', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'custom_projects_search',
		'permission_callback' => '__return_true'
	));		
	
	register_rest_route( 'custom-projects', 'page', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'custom_projects_page',
		'permission_callback' => '__return_true'
	));
});


function custom_projects_search( $request ) {
	
	$options = array(
		'post_type' => 'project',
	);
	
	if ( isset($_REQUEST['s']) && strlen($_REQUEST['s']) ){ 
		$options['s'] = $_REQUEST['s'];
	} 
	
	$projects = get_posts($options);
	
	foreach( $projects as $project ){
		$project->url = get_post_permalink($project);
		$project->excerpt = get_the_excerpt($project);		
	}
	
	return array('results' => $projects);
}

function custom_projects_page( $request ) {

	$options = array(
		'numberposts' => 6,
		'post_type' => 'project',
		'paged' => $_REQUEST['page']
	);
		
	$projects = get_posts($options);
	
	foreach( $projects as $project ){
		$project->url = get_post_permalink($project);
		$project->excerpt = get_the_excerpt($project);		
	}
	
	return array('results' => $projects, 'total' => wp_count_posts('project')->publish);
}


