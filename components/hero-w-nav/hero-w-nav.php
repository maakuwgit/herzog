<?php
/**
* Hero with Anchor Navigation
* -----------------------------------------------------------------------------
*
* Clones the Hero component and adds nav
*/

$defaults = [
  'headline' => array(
    'text' => null,
    'tag'  => 'h1'
  ),
  'type'    => 'image',
  'has_cta' => false,
  'button' => null,
  'show_icon' => true,
  'show_nav' => false,
  'bg_image'  => false,
  'gallery'   => false,
  'loop_video'    => null,
  'popup_video'   => null
];

$args = [
  'id' => uniqid('hero-w-nav-'),
  'nav_id' => uniqid('gallery-'),
  'classes' => array(),
  'targets' => false,
  'is_hero'    => false
];

//Parse all the arguments, and if there's anything empty, fill it
$data = ll_parse_args( $component_data, $defaults );
$args = ll_parse_args( $component_args, $args );

if ( ll_empty( $data ) ) return;

//Assign the reusable values to a variable
$nav_id = $args['nav_id'];
$headline = $data['headline'];
$targets = $args['targets'];
?>
<main class="content hero-w-nav">
  <div class="wrapper row">
    <?php
      //Create a new array with the values we just parse
      $banner = [
        'headline' => array(
          'text' => $headline['text'],
          'tag'  => $headline['tag']
        ),
        'type'    => $data['type'],
        'has_cta' => $data['has_cta'],
        'button' => $data['button'],
        'bg_image'  => $data['bg_image'],
        'gallery'   => $data['gallery'],
        'loop_video'    => $data['loop_video'],
        'popup_video'   => $data['popup_video']
      ];

      //..assuming everything has a value and it's not an array of emptiness
      if( $banner ) {
        ll_include_component(
          'banner',
          $banner,
          array(
            'id' => $args['id'],
            'nav_id' => $nav_id
          )
        );
      }
?>
    <?php if ( $headline['text'] ) : ?>
    <h1 class="hero center col col-lg-9of12 col-xl-8of12"><?php echo $headline['text']; ?></h1>
    <?php endif; ?>
    <?php
      if(!$targets) {
        $targets = get_field('anchor_btn');
      }

      if( $targets ) {
        ll_include_component(
          'anchor_nav',
          $targets
        );
      }?>
  </div>
</main>
<?php
  //Do we need navigation? If so, let's include it
  if( sizeof($data['gallery']) > 0 && $data['type'] === 'gallery' ) {
    include( locate_template('templates/partials/navigation-hero-gallery.php') );
  }
?>