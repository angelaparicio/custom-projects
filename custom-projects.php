<?php

/*
Plugin Name: Custom projects
Description: Plugin de ejemplo para un CPT de proyectos
Author: Angel Aparicio
Version: 0.1
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

defined('ABSPATH' ) or die('No script kiddies please!' );

include( dirname( __FILE__ ) . '/cpt.php' );
include( dirname( __FILE__ ) . '/functions.php' );
include( dirname( __FILE__ ) . '/shortcode.php' );
include( dirname( __FILE__ ) . '/endpoint.php' );

//Hojas de estilos y scripts para el frontend
add_action('wp_enqueue_scripts', function(){

	wp_enqueue_script('custom-projects-frontend', plugins_url('assets/frontend.js', __FILE__), array('jquery') );
	
	wp_localize_script('custom-projects-frontend', 'ajax_var', array(
		'custom_projects_url_search' => rest_url('/custom-projects/search'),
		'custom_projects_url_page' => rest_url('/custom-projects/page'),
		'nonce'  => wp_create_nonce('wp_rest')
	));
	
	//Bootstrap
	wp_enqueue_style( 'bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' );
	wp_enqueue_script( 'bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js');


});

//Crear entradas al instalar
register_activation_hook( __FILE__, 'custom_projects_install');

