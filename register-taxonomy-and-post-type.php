
add_action( 'init', 'nalog__register_my_cpts' );
function nalog__register_my_cpts() {
	$labels = array(
		"name" => 'Инспекции',
		"singular_name" => 'Инспекция',
		);

	$args = array(
		"label" => 'Инспекции',
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => false, 
		"query_var" => true,
				
		"supports" => array( "title", "editor", "thumbnail"/*, "custom-fields"*/ ),		
		"taxonomies" => array( "region" ),					
	);
	register_post_type( "inspekciya", $args );

}



add_action( 'init', 'nalog__register_my_taxes' );
function nalog__register_my_taxes() {
	$labels = array(
		"name" => 'Регионы',
		"singular_name" => 'Регион',
		);

	$args = array(
		"label" => 'Регионы',
		"labels" => $labels,
		"public" => true,
		"hierarchical" => false,
		"label" => "Регионы",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'nalogovaya'),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "region", array( "inspekciya" ), $args );
	
}
