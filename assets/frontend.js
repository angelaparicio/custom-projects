jQuery(document).ready(function(){

	
	jQuery('#projects-search_button').click(function(){
		
		const headers = new Headers({
			'Content-Type': 'application/json',
			'X-WP-Nonce': ajax_var.nonce
		});
		
		fetch( ajax_var.custom_projects_url_search + '?' + jQuery("#projects-search").serialize(), {
			method: 'get',
			headers: headers,
			credentials: 'same-origin',
		})
		.then(response => {
			return response.ok ? response.json() : 'Not Found...';
		})
		.then(json_response => {
			
			var content = '';
			
			if (typeof json_response === 'object') {
				
				if ( json_response.results.length == 0 ){
					content = 'No results have been found';
				}
				else {
					
					json_response.results.forEach((element, index, data) => {
						content += custom_projects_aux_get_element(element);
					});
				}
				
				jQuery('#projects-list').html(content);
			}
			
		});
		
		return false;
	});
	
	
	jQuery('#projects-pagination button').click(function(){
		
		var page = jQuery(this).data('page');
		
		const headers = new Headers({
			'Content-Type': 'application/json',
			'X-WP-Nonce': ajax_var.nonce
		});
		
		fetch( ajax_var.custom_projects_url_page + '?page=' + page, {
			method: 'get',
			headers: headers,
			credentials: 'same-origin',
		})
		.then(response => {
			return response.ok ? response.json() : 'Not Found...';
		})
		.then(json_response => {
		
			var content = '';
		
			if (typeof json_response === 'object') {
				
				if ( json_response.results.length == 0 ){
					content = 'No results have been found';
				}
				else {
					
					json_response.results.forEach((element, index, data) => {
						content += custom_projects_aux_get_element(element);
					});
					
					custom_projects_aux_pagination_buttons(json_response.total, page);
				}
				
				jQuery('#projects-list').html(content);
			}
		
		});
		
		return false;
		
	});
	
});	

function custom_projects_aux_get_element(element){
	
	content = '<div id="project-element-' + element.ID + '" class="project-element-wrapper">';
		
		content += '<h2 class="project-element-title">';
		content += '<a href="' + element.url + '">' + element.post_title + '</a>';
		content += '</h2>';
		
		content += '<div class="project-element-excerpt">';
		content += element.excerpt;
		content += '</div>';
		
	content += '</div>';
	
	return content;
}

function custom_projects_aux_pagination_buttons(total, page){
	
	var prev = page + 1;
	var next = page - 1;
	var numberposts = 6;
	
	if ( next ){
		jQuery('#projects-pagination-next').data('page', next);
		jQuery('#projects-pagination-next').prop('disabled', false);
	}
	else {
		jQuery('#projects-pagination-next').data('page', '-');
		jQuery('#projects-pagination-next').prop('disabled', true);
	}
	
	if ( numberposts * page < total ){
		jQuery('#projects-pagination-prev').data('page', prev);
		jQuery('#projects-pagination-prev').prop('disabled', false);
	}
	else {
		jQuery('#projects-pagination-prev').data('page', '-');
		jQuery('#projects-pagination-prev').prop('disabled', true);	
	}
	
}
