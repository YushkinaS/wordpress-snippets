add_action( 'region_add_form_fields', 'add_where_field', 10, 2 );
function add_where_field($taxonomy) {

    ?>
	<div class="form-field term-group">
    <label for="where">Где?</label>
    <input type="text" class="postform" name="where" />
    </div>
	<?php
}


add_action( 'created_region', 'save_where_meta', 10, 2 );
function save_where_meta( $term_id, $tt_id ){
    if( isset( $_POST['where'] ) && '' !== $_POST['where'] ){
		$value = $_POST['where'];
        add_term_meta( $term_id, 'where', $value, true );
    }
}

add_action( 'region_edit_form_fields', 'edit_where_field', 10, 2 );
function edit_where_field( $term, $taxonomy ){      
    $where = get_term_meta( $term->term_id, 'where', true );      
	
	   ?><tr class="form-field term-group-wrap">
        <th scope="row"><label for="where">Где?</label></th>
        <td><input type="text" name="where" value="<?php echo $where; ?>" /></td>
    </tr><?php
	

}

add_action( 'edited_region', 'update_where_meta', 10, 2 );
function update_where_meta( $term_id, $tt_id ){

    if( isset( $_POST['where'] ) && '' !== $_POST['where'] ){
        $value = $_POST['where'];
        update_term_meta( $term_id, 'where', $value);
    }
}
