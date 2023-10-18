<?php

defined('ABSPATH' ) or die('No script kiddies please!' );

add_shortcode( 'show_projects', function(){
	
	$shortcode  = '<div id="projects-wrapper">';	
	$shortcode .= '<div id="projects-search-wrapper"> 
	<form id="projects-search"> 
		<input name="s" value="" placeholder="Search..." /> 
		<input id="projects-search_button" class="btn btn-primary" type="submit" value="Search" /> 
	</form>
	</div>';
	
	$shortcode .= '<div id="projects-pagination">';
		$shortcode .= '<button id="projects-pagination-next" type="button" data-page="-" class="btn btn-primary btn-sm" disabled>Next</button> &nbsp; - &nbsp; ';
		$shortcode .= '<button id="projects-pagination-prev" type="button" data-page="2" class="btn btn-primary btn-sm">Previous</button>';
	$shortcode .= '</div>';

	$projects = get_posts( array(
		'post_type' => 'project',
		'numberposts' => 6
	));
	
	$shortcode  .= '<div id="projects-list-wrapper" class="container">';	
		$shortcode  .= '<div id="projects-list" class="row row-cols-1 row-cols-md-2">';
		
			foreach ( $projects as $project ):
				
				$shortcode .= '<div id="project-element-'.$project->ID.'" class="project-element-wrapper">';
					
					$shortcode .= '<h2 class="project-element-title">';
					$shortcode .= '<a href="'.get_post_permalink($project).'">'.$project->post_title.'</a>';
					$shortcode .= '</h2>';
					
					$shortcode .= '<div class="project-element-excerpt">';
					$shortcode .= get_the_excerpt($project->ID);
					$shortcode .= '</div>';
					
				$shortcode .= '</div>';
				
			endforeach;
		
		$shortcode .= '</div>';	
	$shortcode .= '</div>';

	
	$shortcode .= '</div>';
	
	return $shortcode;
});