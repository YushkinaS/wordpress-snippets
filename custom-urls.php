add_action('init', 'rewrite_rule_my');
function rewrite_rule_my(){
	add_rewrite_tag('%region%', '([^&]+)');
	add_rewrite_tag('%city%', '([^&]+)');
	
	$post_type = 'inspekciya';
	$permastruct = "nalogovaya/%region%/%city%/%postname%";
	add_permastruct( $post_type, $permastruct);
	
	add_rewrite_rule( '^nalogovaya/([^/]*)/([^/]*)/([^/]*)/?', 'index.php?inspekciya=$matches[3]&region=$matches[1]&city=$matches[2]', 'top' );
	add_rewrite_rule( '^nalogovaya/([^/]*)/([^/]*)/?', 'index.php?inspekciya=$matches[2]&region=$matches[1]', 'top' );
}

add_filter( 'post_type_link', 'inspekciya_permalink',1,2);
function inspekciya_permalink( $post_link, $id = 0 ){
	$post = get_post($id);
	if ( is_object( $post ) && $post->post_type == 'inspekciya' ){

		$terms = wp_get_object_terms( $post->ID, 'region' );
		if( $terms ){
			$post_link = str_replace('%region%',$terms[0]->slug,$post_link);
		}
		
		$city = get_post_meta($post->ID,'city_for_url',true);
		if (!empty($city)) {
			$post_link = str_replace('%city%',$city,$post_link);
		}
		else{
			$post_link = str_replace('/%city%','',$post_link);
		}
		
		$post_link = str_replace('%postname%',$post->post_name,$post_link);

	}
	return $post_link;
}
