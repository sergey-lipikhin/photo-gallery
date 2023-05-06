<?php
// Add image support
add_theme_support('post-thumbnails' );
/* --
 Custom post type and taxonomy for Gallery Photos
-- */
add_action('init', 'create_gallery_function');
function create_gallery_function(){
    $labels = array(
        'name' => _x('Gallery Photos', 'post type general name', 'your_text_domain'),
        'singular_name' => _x('Gallery Photos', 'post type Singular name', 'your_text_domain'),
        'add_new' => _x('Add Gallery Photo', '', 'your_text_domain'),
        'add_new_item' => __('Add New Gallery Photo', 'your_text_domain'),
        'edit_item' => __('Edit Gallery Photo', 'your_text_domain'),
        'new_item' => __('New Gallery Photo', 'your_text_domain'),
        'all_items' => __('All Gallery Photos', 'your_text_domain'),
        'view_item' => __('View Gallery Photo', 'your_text_domain'),
        'search_items' => __('Search Gallery Photo', 'your_text_domain'),
        'not_found' => __('No Gallery Photos found', 'your_text_domain'),
        'not_found_in_trash' => __('No Gallery Photos on trash', 'your_text_domain'),
        'parent_item_colon' => '',
        'menu_name' => __('Gallery Photos', 'your_text_domain')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'page',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => null,
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array('title', 'thumbnail')
    );
    $labels = array(
        'name' => __('Category'),
        'singular_name' => __('Category'),
        'search_items' => __('Search'),
        'popular_items' => __('More Used'),
        'all_items' => __('All Categories'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Add new'),
        'update_item' => __('Update'),
        'add_new_item' => __('Add new Category'),
        'new_item_name' => __('New')
    );
    register_taxonomy('gallery_photo_category', array('gallery_photo'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'singular_label' => 'gallery_photo_category',
		'all_items' => 'Category',
		'query_var' => true)
    );
    register_post_type('gallery_photo', $args);
    flush_rewrite_rules();
}

add_action( 'wp_ajax_pb_filter', 'wp_ajax_pb_filter' );
function wp_ajax_pb_filter(){
	if ( !wp_verify_nonce( $_POST['security'], 'pb-image-filter' ) ){
        wp_die('Security error');
	}
	$category = $_POST['category'];

	$args = array(
		'post_type' => 'gallery_photo',
		'posts_per_page' => 8);
	$query = new WP_Query($args);
	$articlesOut = '';
	while ($query->have_posts()) {
		$query->the_post();
		$termsArray = get_the_terms($post->ID, 'gallery_photo_category');
		$termsSLug = "";
		foreach ($termsArray as $term) {
			$termsSLug .= $term->slug;
		}
		if (!strcmp( $termsSLug, $category) || !strcmp( 'all', $category)) {
			$articleOut = '';
			$articleOut = '<article class="location-listing location-listing-' . $termsSLug . '">';
			$articleOut .= '<div class="location-title">' . get_the_title($post->ID) . '</div>';
			$articleOut .= '<div class="location-image"><img class="image-super-syle" src="' . get_the_post_thumbnail_url( $post->ID ) . '"></div></article>';
			$articlesOut .= $articleOut;
		}
	}
	wp_reset_postdata();
	wp_die($articlesOut);
}
