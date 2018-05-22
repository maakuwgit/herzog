<?php
/**
 * Excerpt Modifications
 */
//Setup the content so we can get the truncated version to be short and sweet
function ll_excerpt_length( $length ) {
  return 16;
}
add_filter( 'excerpt_length', 'll_excerpt_length' );

//Furthermore, we don't need "Continued.." gumming up our visual
function ll_excerpt_more($more) {
  return '';
}
add_filter('excerpt_more', 'll_excerpt_more');