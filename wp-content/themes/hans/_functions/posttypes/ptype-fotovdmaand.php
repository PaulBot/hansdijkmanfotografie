<?php
	
	function build_fotovdmaand_post_type()
	{
		register_post_type('fotovdmaand',
							array(
								'labels'		=> array(
														'name'				=> 'Foto van de maand',
														'singular_name'		=> 'Foto van de maand',
														'add_new_item'		=> 'Foto van de maand toevoegen',
														'add_new'			=> 'Foto van de maand toevoegen',
														'all_items'			=> 'Alle Foto van de maand items'
													),
								'public' 		=> true,
								'menu_position'	=> 20,
								'hierarchical'	=> true,
								'supports' => array('title', 'editor' , 'thumbnail')
							)
		);
	}
	add_action('init', 'build_fotovdmaand_post_type');

	 add_theme_support( 'post-thumbnails', array( 'post' ) );


?>