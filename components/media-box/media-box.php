<?php
/**
* Media Box
* -----------------------------------------------------------------------------
*
* media-box component
*/
$id = uniqid('mediabox-');

$default_data = [
  'padded_top'        => false,
  'padded_bottom'     => false,
  'mediabox_columns'  => array(
    array(
      'mediabox_bg'         => array(),
      'mediabox_button'       => false,
      'mediabox_button_style' => 'light',
      'mediabox_headline'     => 'Headline',
      'mediabox_subheadline'  => 'Subheadline',
      'mediabox_content'      => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
      'mediabox_type'         => false,
      'hero_gallery'          => array(
        'hero_gallery_image' => array()
      ),
      'hero_video'            => false
    )
  )
];

$default_args = [
  'classes' => array(),
  'id'      => $id
];

$data = ll_parse_args( $component_data, $default_data );
$args = ll_parse_args( $component_args, $default_args );

if ( ll_empty( $data ) ) return;

  if( $data['mediabox_columns'] ) {
    $first = true;
    $right_box = $left_box = $rimage = $limage = '';
    $rtype = $ltype = $rbtn = $lbtn = $lgallery = $rgallery = '';

    foreach( $data['mediabox_columns'] as $media ) {
      $nav_id       = uniqid('mb-gallery-');
      $gallery      = $media['hero_gallery'];
      $video        = $media['hero_video'];
      $btn          = $media['mediabox_button'];
      $headline     = $media['mediabox_headline'];
      $subheadline  = $media['mediabox_subheadline'];
      $content      = $media['mediabox_content'];
      $hero         = $media['mediabox_bg'];
      $type         = $media['mediabox_type'];

      if( $headline ) {
        $headline = '<h2 class="h1">' . $headline . '</h2>';
      }
      if( $subheadline ) {
        $subheadline = '<h3 class="p">' . $subheadline . '</h3>';
      }

      if( $first === true ) {
        $left_box = $headline . $subheadline . $content;
        $limage   = $hero;
        $lbtn     = $btn;
        $lgallery = $gallery;
        $ltype    = $type;
        $lnav_id  = $nav_id;
      }else{
        $right_box = $headline . $subheadline . $content;
        $rimage   = $hero;
        $rbtn     = $btn;
        $rgallery = $gallery;
        $rtype    = $type;
        $rnav_id  = $nav_id;
      }
      $first = false;
    }
  }
  $css = ' class="media-box';
  if( $args['classes'] ) {
    if( is_array($args['classes'] ) ) {
      $css .= implode( " ", $args['classes'] );
    }else{
      $css .= ' ' . $args['classes'];
    }
  }
  $css .= '"';
  $id = ($args['id'] ? ' id="' . $args['id'] . '"' : '');
?>
<section<?php echo $id . $css; ?> data-component="media-box">
  <div class="container row">
    <article class="col col-lg-4of12 col-xl-4of12 active" data-rel="left" data-btn-href="<?php echo $lbtn['url']; ?>" data-btn-title="<?php echo $lbtn['title']; ?>">
      <div class="row">
        <header class="col">
          <?php echo $left_box; ?>
        </header>
        <?php if( $ltype === 'video' ) : ?>
        <nav class="col">
          <a class="button" href="<?php echo $lbtn['url']; ?>'" title="<?php echo $lbtn['title']; ?>">
            <svg class="icon icon-play">;
              <use xlink:href="#icon-play"></use>
            </svg>
            <span class="white">Play Video</span>
          </a>
        </nav>
        <?php endif; ?>
      </div>
      <?php if( $ltype === 'gallery' ) : $nav_id = $lnav_id; ?>
        <?php include( locate_template('templates/partials/navigation-gallery.php') ); ?>
      <?php endif; ?>
    </article>
    <figure class="col col-lg-4of12 col-xl-4of12" data-background>
      <div class="feature">
        <?php echo ll_format_image($limage); ?>
        <?php echo ll_format_image($rimage); ?>
      </div>
      <div data-rel="left" style="display:block;">
        <?php
        if( $ltype === 'gallery' ) {
          if( sizeof($lgallery) > 0 ) {
            ll_include_component(
              'gallery',
              array(
                'gallery' => $lgallery
              ),
              array(
                'is_hero'    => true,
                'nav_id'     => $lnav_id
              )
            );
          }
          //Gallery code
        }
        ?>
      </div>
      <div data-rel="right">
        <?php
        if( $rtype === 'gallery' ) {
          if( sizeof($rgallery) > 0 ) {
            ll_include_component(
              'gallery',
              array(
                'gallery' => $rgallery
              ),
              array(
                'is_hero'    => true,
                'nav_id'     => $rnav_id
              )
            );
          }
          //Gallery code
        }
        ?>
      </div>
    <?php if( $rbtn ) : ?>
      <a class="button" href="<?php echo $rbtn['url']; ?>" title="<?php echo $rbtn['title']; ?>">
        <svg class="icon icon-chevron-left">
          <use xlink:href="#icon-chevron-left"></use>
        </svg>
      </a>
    <?php endif; ?>
    </figure>
    <article class="col col-lg-4of12 col-xl-4of12" data-rel="right" data-btn-href="<?php echo $lbtn['url']; ?>" data-btn-title="<?php echo $lbtn['title']; ?>">
      <div class="row">
        <header class="col">
          <?php echo $right_box; ?>
        </header>
        <?php if( $rtype === 'video' ) : ?>
        <nav class="col" style="display:none;">
          <a class="button" href="<?php echo $rbtn['url']; ?>'" title="<?php echo $rbtn['title']; ?>">
            <svg class="icon icon-play">;
              <use xlink:href="#icon-play"></use>
            </svg>
            <span class="white">Play Video</span>
          </a>
        </nav>
        <?php endif; ?>
      </div>
      <?php if( $rtype === 'gallery' ) : $nav_id = $rnav_id;?>
        <?php include( locate_template('templates/partials/navigation-gallery.php') ); ?>
      <?php endif; ?>
    </article>
  </div>
</section>
