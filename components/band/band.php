<?php
/**
* Band
* -----------------------------------------------------------------------------
*
* Band component
* @since 1.6.5
* @author MaakuW
*/
global $post;

/**
 * Default component data.
 *
 * @var array
 * @see data[]
 */
$id = uniqid('band-');

$default_data = [
  'has_background' => false,
  'section_bg'     => array(),
  'is_stretched'   => false,
  'navbar'         => array(),
  'padded_top'     => false,
  'padded_bottom'  => false,
  'band_columns'   => array(
    array(
      'band_colspan'        => '3',
      'band_bg'             => array(),
      'column_button'       => false,
      'button_style'        => 'light',
      'band_align'          => 'flex-start',
      'band_content'        => '<h5>Lorem ipsum</h5><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'
    )
  )
];

$default_args = [
  'classes' => array(),
  'id'      => $id
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

/**
 * component_name_before_display hook
 * Type: Action
 */
do_action( "component_name_before_display", $component_data, $component_args );
?>

<?php
if ( ll_empty( $data ) ) return;

$has_background = $data['has_background'];
$section_bg     = $data['section_bg'];
$stretch        = $data['is_stretched'];
$padded_top     = $data['padded_top'];
$padded_bottom  = $data['padded_bottom'];
$navbar         = $data['navbar'];
$css = ' class="band content';

if( $args['classes'] ) {
  $css .= 'flex-start ';

  if( is_array($args['classes'] ) ) {
    $css .= implode( " ", $args['classes'] );
  }else{
    $css .= ' ' . $args['classes'];
  }
  if( $has_background ) {
    $css .=  ' has-image';
  }else{
    $css .= ' no_bg';
  }
  if( $stretch ) {
    $css .= ' stretch';
  }
}
if( $padded_top === true ) {
  $css .= ' padded-top';
}
if( $padded_bottom === true ) {
  $css .= ' padded-bottom';
}
$css .= '"';

$id = ' id="' . $args['id'] . '"';

//Background for the section element
if ( $section_bg ) {
 $style = ' style="background-image: url( '. $section_bg['url'] .' );"';
} else {
 $style = '';
}
?>
<section<?php echo $id . $css . $style; ?>>
  <div class="container row start">
<?php
  if( $data['band_columns'] ) :
    foreach( $data['band_columns'] as $band ) :
      //Column Alignment
      $align      = ( $band['band_align'] === null ? '' : ' ' . $band['band_align'] );
      $col_btn    = $band['column_button'];
      $btn_style  = $band['button_style'];
      $btn_icon   = $band['button_icon'];

      //Background for a column
      ///*Dev Note: replace this with our standard "backgrounder" logic
      $band_bg = $band['band_bg'];
      if ( $band_bg ) {
       $col_style = ' style="background-image: url( '. $band_bg['url'] .' );"';
      } else {
       $col_style = '';
      }
      $col_span = $band['band_colspan'];
      $col_suff = 'of12';

      $col_span_lg = $col_span;
      $col_span_xl = $col_span;
      switch($col_span){
        case 3:
          $col_span_md = 4;
          $col_span_sm = 6;
          $col_span_xs = 6;
        break;
        case 4:
        case 5:
        case 6:
          $col_span_md = $col_span;
          $col_span_sm = $col_span;
          $col_span_xs = 12;
        break;
        default:
          $col_span_sm = $col_span;
          $col_span_xs = $col_span;
          $col_span_md = $col_span;
        break;
      }

      $col_xs = 'col-xs-' . $col_span_xs . $col_suff;
      $col_sm = 'col-sm-' . $col_span_sm . $col_suff;
      $col_md = 'col-md-' . $col_span_md . $col_suff;
      $col_lg = 'col-lg-' . $col_span_lg . $col_suff;
      $col_xl = 'col-xl-' . $col_span_xl . $col_suff;
      $col_class = ' class="col '.$col_xs.' '.$col_sm.' '.$col_md.' '.$col_lg.' '.$col_xl.$align.'"';
?>
    <div<?php echo $id . $col_class . $col_style; ?> data-component="band"><?php echo $band['band_content']; ?>
      <?php
      if( $col_btn ) {
        $button = array(
          'icon'  => $btn_icon,
          'theme' => $btn_style,
          'link'  => array(
            'title' => $col_btn['title'],
            'url'  => $col_btn['url']
          )
        );

        ll_include_component(
          'button',
          $button,
          array(
            'classes' => array($btn_style),
          )
        );
      }
      ?>
    </div>
<?php
  endforeach;
?>
  <?php if( $navbar ) : ?>
    <nav class="col-12of12">
    <?php
      foreach( $navbar as $band_btn ) {
        if( $band_btn ) {
          $button = array(
            'text' => $band_btn['btn']['title'],
            'link' => array(
              'title' => $band_btn['btn']['title'],
              'href'  => $band_btn['btn']['url']
            )
          );

          ll_include_component(
            'button',
            $button
          );
        }
      }
      ?>
    </nav>
  <?php endif; ?>
  </div>
<?php endif; ?>
</section>

<?php
/**
 * component_name_after_display hook
 * Type: Action
 */
do_action( "component_name_after_display", $component_data, $component_args ); ?>
