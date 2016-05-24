# wordpress-snippets

##add columns to admin posts list
```php
add_filter('manage_product_posts_columns','mtw_add_product_posts_columns',100);
add_action('manage_posts_custom_column','mtw_custom_columns',10,2);

function mtw_add_product_posts_columns($cols) {
	update_option('test1',$cols);
	unset($cols['sku']);
	unset($cols['date']);
	unset($cols['product_type']);
	$cols['event_time'] = 'Event time';
	$cols['meetup_url'] = 'Meetup URL';
	return $cols;
}

function mtw_custom_columns( $column, $post_id ) {
	
	if ( 'event_time' == $column ) {
		echo date ( 'M j, Y · H:i',get_post_meta ( $post_id, 'event_time', true ) );
	}
	
	if ( 'meetup_url' == $column ) {
		?>
		<a href="<?php echo get_post_meta ( $post_id, 'meetup_url', true ); ?>">#</a>
		<?php
	}
}
```

## add meta box to wordpress admin page
found at https://wordpress.org/plugins/megamenu/

по хуку 'add_meta_boxes' почему-то не работает
```php
add_action( 'admin_init', 'register_nav_meta_box', 9 );
function register_nav_meta_box() {
        global $pagenow;
        if ( 'nav-menus.php' == $pagenow ) {
            add_meta_box(
			//args here
            );
        }
    }
```    
    
## bootstrap theme design

Calculate bootstrap columns width
```php

function column_class($column="sidebar") {
	$right = is_active_sidebar( "sidebar-right" );
	$left = is_active_sidebar( "sidebar-left" );
	if ($right && $left) {
		$content_width = 6;
		$sidebar_width = 3;
		}
	else if ($right || $left) {
		$content_width = 8;
		$sidebar_width = 4;
		}
	else {
		$content_width = 12;
		$sidebar_width = 0;
		}
	if ($column == "content") {
		return $content_width;
	}
	else if ($column == "sidebar") {
		return $sidebar_width;
	}
	else if ($column == "content-push") {
		return $left ? $sidebar_width : 0;
	}
}
```
use in templates:
```
<div id="primary" class="content-area col-md-<?php echo column_class("content"); ?>">
<div class="wrapper col-md-<?php echo column_class("sidebar"); ?>">
```
pull and push:
content
```
<div id="primary" class="content-area col-xs-12 col-md-<?php 
	echo column_class("content"); ?> col-md-push-<?php 
	echo column_class("content-push"); ?>">
```
left sidebar
```
<div class="wrapper col-xs-12 col-md-<?php 
	echo column_class("sidebar"); ?> col-md-pull-<?php 
	echo column_class("content"); ?>">
```
