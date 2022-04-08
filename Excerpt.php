To add character limit in excerpt:
function custom_excerpt_length( $length ) {
  return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

To create custom shortcode for Excerpt:
add_shortcode( 'post_excerpt', 'get_the_excerpt' );

