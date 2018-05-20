<?php
/**
* related-nav
* -----------------------------------------------------------------------------
*
* related-nav component
*/


$default_data = [
  'links'
];

$default_args = [
  'id' => uniqid('related-nav-'),
  'classes' => array()
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

//if ( ll_empty( $component_data ) ) return;

$css = 'class="related-nav';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';

$id       = $args['id'];
?>
<aside<?php echo ' id="'.$id.'"'; ?> data-component="related-nav"<?php echo $css; ?>>
  <button class="button" data-trigger="related-nav">
    <svg width="29px" height="29px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="related-nav-compass" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
      <path d="M14.5,27 C7.59644063,27 2,21.4035594 2,14.5 C2,7.59644063 7.59644063,2 14.5,2 C21.4035594,2 27,7.59644063 27,14.5 C27,21.4035594 21.4035594,27 14.5,27 Z M14.5,4 C8.70101013,4 4,8.70101013 4,14.5 C4,20.2989899 8.70101013,25 14.5,25 C20.2989899,25 25,20.2989899 25,14.5 C25,8.70101013 20.2989899,4 14.5,4 Z"></path>
      <path d="M15.9561305,14.8615822 C15.9847922,14.7457761 16,14.624664 16,14.5 C16,13.6715729 15.3284271,13 14.5,13 C14.3202436,13 14.1478723,13.0316194 13.9881446,13.0895996 L13.3685858,12.5317464 L21.148756,7.16746476 L16.6271096,15.4657345 L15.9561305,14.8615822 Z M13.0257653,14.2217127 C13.0088479,14.3118897 13,14.4049116 13,14.5 C13,15.3284271 13.6715729,16 14.5,16 C14.6497999,16 14.7944711,15.9780412 14.9309703,15.937167 L15.6332624,16.5695136 L7.85309222,21.9337953 L12.3747386,13.6355256 L13.0257653,14.2217127 Z"></path>
    </g>
</svg>
  </button>
  <nav class="row">
    <h6>Related Pages</h6>
    <dl>
      <dt>About</dt>
      <dd>About Us</dd>
      <dt>About</dt>
      <dd>History Timeline</dd>
      <dt>About</dt>
      <dd>Leadership</dd>
      <dt>About</dt>
      <dd>Inquiries, Comments &amp; Questions</dd>
    </dl>
  </nav>
</aside>
