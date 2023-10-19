<?php

defined('ABSPATH' ) or die('No script kiddies please!' );

function custom_projects_install() {
	
	$posts = get_posts( array(
		'post_type' => 'project',
	));

	if ( empty($posts) ){
		
		for ($i = 1; $i <= 30; $i++) {
			
			$post_data = array(
				'post_title' => 'Project '.$i,
				'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
				'post_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
				'post_type' => 'project',
				'post_status' => 'publish',
			);
			
			wp_insert_post($post_data);
		}
	}
	
}

