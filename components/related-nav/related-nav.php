<?php
/**
* related-nav
* -----------------------------------------------------------------------------
*
* related-nav component
*/


$default_data = [
  'links' => array(
    array(
      'relationship' => array()
    )
  )
];

$default_args = [
  'id' => uniqid('related-nav-'),
  'classes' => array()
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

if ( ll_empty( $data['links'] ) ) return;

$css = 'class="related-nav';
if( $args['classes'] ) {
  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
}
$css .= '"';

$id = $args['id'];

?>
<aside<?php echo ' id="'.$id.'"'; ?> data-component="related-nav"<?php echo $css; ?>>
  <button class="button" data-trigger="related-nav">
    <?php get_navigator(); ?>
  </button>
  <nav class="row">
    <h6 class="h5 text-normal">Related Pages</h6>
    <?php if( array_key_exists( 'links', $data ) ) : ?>
    <dl>
    <?php
      foreach( $data['links'] as $link) :
        $page = $link['relationship'];
    ?>
      <div class="row start">
        <dt class="col col-4of12 flex-start"><?php echo $page['rel_parent'];?></dt>
        <dd class="col col-8of12 flex-start"><a href="<?php echo $page['rel_url'];?>" target="_self"><?php echo $page['rel_label'];?></a></dd>
      </div>
    <?php endforeach; ?>
    </dl>
  <?php endif; ?>
  </nav>
</aside>