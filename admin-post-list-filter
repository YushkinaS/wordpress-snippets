function add_region_filter_to_inspekciya_administration(){

    //execute only on the 'inspekciya' content type
    global $post_type;
    if($post_type == 'inspekciya'){

        $post_formats_args = array(
            'show_option_all'   => 'Все регионы',
            'orderby'           => 'NAME',
            'order'             => 'ASC',
            'name'              => 'region_admin_filter',
            'taxonomy'          => 'region'
        );

        //if we have a post format already selected, ensure that its value is set to be selected
        if(isset($_GET['region_admin_filter'])){
            $post_formats_args['selected'] = sanitize_text_field($_GET['region_admin_filter']);
        }

        wp_dropdown_categories($post_formats_args);



    }
}
add_action('restrict_manage_posts','add_region_filter_to_inspekciya_administration');


//restrict the posts by the chosen post format
function add_region_filter_to_inspekciya($query){

    global $post_type, $pagenow;

    //if we are currently on the edit screen of inspekciya post type listings
    if($pagenow == 'edit.php' && $post_type == 'inspekciya'){
        if(isset($_GET['region_admin_filter'])){

            //get the desired post format
            $region = sanitize_text_field($_GET['region_admin_filter']);
            //if the post format is not 0 (which means all)
            if($region != 0){

                $query->query_vars['tax_query'] = array(
                    array(
                        'taxonomy'  => 'region',
                        'field'     => 'ID',
                        'terms'     => array($region)
                    )
                );

            }
        }
    }   
}
add_action('pre_get_posts','add_region_filter_to_inspekciya');
