<?php 

// extra fields

require_once('_functions/fields/attachment-fields.php');

//post types

require_once('_functions/posttypes/ptype-fotovdmaand.php');


//add image sizes


function add_custom_image_sizes() {
	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'fotovdmaand') );
    add_image_size( 'slider', 1920, 1080, true  ); 
    add_image_size( 'text', 720, 0, false);
    add_image_size( 'gallery', 550, 0, false);

}
add_action( 'after_setup_theme', 'add_custom_image_sizes' );


function my_image_sizes($sizes) {
	$addsizes = array(
		"slider" => __( "Slider"),
		"text" => __( "Text"),
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}
add_filter('image_size_names_choose', 'my_image_sizes');
	

function register_scripts(){

	if(WP_DEBUG){

		wp_enqueue_script( 'vendor', get_template_directory_uri() . '/assets/scripts/vendor.js', array(), null, true);
		wp_enqueue_script( 'jMosaic', get_template_directory_uri() . '/assets/scripts/jMosaic.js', array(), 'jquery', true);
		wp_enqueue_script( 'custom-scrollbar', get_template_directory_uri() . '/assets/scripts/custom-scrollbar.js', array(), 'jquery', true);
		wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/scripts/main.js', array('vendor'), null, true);
	 
	} else {
		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/scripts/scripts.js', array(), null, true);
	}
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/scripts/modernizr.js', array(), null, false);
	wp_enqueue_style( 'vendorcss', get_template_directory_uri() . '/assets/styles/vendor.css');
	wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/styles/main.css');
}
add_action( 'wp_enqueue_scripts', 'register_scripts' );

register_nav_menus( array(
	'hoofdmenu' => 'Hoofdmenu'
) );


function load_custom_wp_admin_style() {
        wp_enqueue_script( 'admin_scripts' , get_template_directory_uri() . '/assets/js/admin_scripts.js', false, false, true);
        wp_enqueue_style( 'admin_styles' , get_template_directory_uri() . '/assets/css/admin_styles.css');
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );


function disable_wp_headfiles() {

	 // all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' 	);
	remove_action( 'wp_head', 'feed_links_extra', 3 ); 
	remove_action( 'wp_head', 'feed_links', 2 ); 
	remove_action( 'wp_head', 'rsd_link' ); 
	remove_action( 'wp_head', 'wlwmanifest_link' ); 
	remove_action( 'wp_head', 'index_rel_link' ); 
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); 
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); 
	remove_action( 'wp_head', 'wp_generator' ); 

  // filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_headfiles' );

function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function get_slider_images() {
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' =>'image',
        'post_status' => 'inherit',
        'meta_key'	=> 'slider_order',
		'orderby'	=> 'meta_value_num',
        'posts_per_page' => -1,
        'order'				=> 'DESC',
        'media_category'=> 'homeslider'
    );

    $query_images = new WP_Query( $args );
    $images = array();
    foreach ( $query_images->posts as $image) {
    	$image_id = $image->ID;
        $images[]= $image;
    }
    return $images;
}

function get_library_images($category=0) {

	$homeslider =  get_term_by( 'name', 'homeslider', 'media_category' );
	$homeslider_id = $homeslider->term_id;

    $args = array(
        'post_type' 		=> 'attachment',
        'post_mime_type' 	=>'image',
        'post_status' 		=> 'inherit',
        'posts_per_page' 	=> -1,
        'order'				=> 'DESC',
        'exclude'   		=> $homeslider_id,
        'media_category'	=> $category
        );

    $query_images = new WP_Query( $args );
    $images = array();
    foreach ( $query_images->posts as $image) {
    	$image_id = $image->ID;
        $images[]= $image;
    }
    return $images;
}

function new_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> ...  Lees meer</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
