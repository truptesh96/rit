<?php 
// Hook into post update or publish
add_action('save_post', 'generate_post_css_file');

function generate_post_css_file($post_id) {
    // Ensure it's not an auto-save or a revision
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
        return;
    }
	
    // Define the path to save the CSS file
    $upload_dir = wp_upload_dir();
    $css_dir = $upload_dir['basedir'] . '/assets/css/';
    $css_file = $css_dir . 'post' . $post_id . '.css';

    // Create the directory if it doesn't exist
    if (!file_exists($css_dir)) {
        wp_mkdir_p($css_dir);
    }

    // Start CSS output
    $dynamic_css = "";

    // Loop through ACF flexible content fields
    if( have_rows('flexible_content', $post_id) ):
        while( have_rows('flexible_content', $post_id) ) { the_row();
        	$section_id =  get_sub_field('section_id') ? get_sub_field('section_id') : 'sec_' . get_row_index();
			/*-- Bg Color --*/
			if (get_sub_field('section_bg_color')) {
			    $section_background = get_sub_field('section_bg_color');
			    $dynamic_css .= "
			        #{$section_id} {
			            background-color: {$section_background};
			        }
			    ";
			}
        }
    endif;

	$dynamic_css = preg_replace('/\s+/', '', $dynamic_css);

    // Save the CSS content to the file
    file_put_contents($css_file, $dynamic_css);
}

// Enqueue the dynamically generated CSS for a specific post
add_action('wp_enqueue_scripts', 'enqueue_post_css');

function enqueue_post_css() {
   
	global $post;
	$post_id = $post->ID;
	$upload_dir = wp_upload_dir();
	$css_file_url = $upload_dir['baseurl'] . '/assets/css/post' . $post_id . '.css';

	// Only enqueue if the CSS file exists
	if (file_exists($upload_dir['basedir'] . '/assets/css/post' . $post_id . '.css')) {
		wp_enqueue_style('page' . $post_id, $css_file_url);
	}
   
}

?>