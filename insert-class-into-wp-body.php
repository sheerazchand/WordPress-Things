<?php 
/*
* Here is how you can insert a class into body of the WordPress
* The first one is simple class you can add.
* And the second one is ACF class you can add.
*
*/

/* Here is how you can add a simple class via function.php */
add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
    $classes[] = 'class-name';
    return $classes;
}




/* And here is how you can add a ACF field as class or add a class based on ACF Condition via function.php */
add_filter( 'body_class', 'custom_body_class' );
/**
 * Add custom field body class(es) to the body classes.
 *
 * It accepts values from a per-page custom field, and only outputs when viewing a singular static Page.
 *
 * @param array $classes Existing body classes.
 * @return array Amended body classes.
 */
function custom_body_class( array $classes ) {
	$new_class = is_page() ? get_post_meta( get_the_ID(), 'field_name', true ) : null;
	if ( $new_class ) {
		$classes[] = $new_class;
    $classes[] = "custom_class_name"; //If you want to add custom class based on condition if ACF field is not empty.
	}

	return $classes;
}
