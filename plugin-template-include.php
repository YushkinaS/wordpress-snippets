add_filter( 'template_include', 'nalog_templates');
function nalog_templates($template) {

	if ( is_singular( 'inspekciya' ) ) {
		$template = plugin_dir_path( __FILE__ ) . '/templates/single-inspekciya.php';
	}


	if ( is_tax('region') ) {
		$template = plugin_dir_path( __FILE__ ) . '/templates/taxonomy-region.php';
	}
	
	if ( is_page('nalogovaya') ) {
		$template = plugin_dir_path( __FILE__ ) . '/templates/page-nalogovaya.php';
	}


	return $template;

}
