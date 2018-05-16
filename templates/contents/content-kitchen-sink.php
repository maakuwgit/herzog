<?php
//Setup our variables
$id = false;
$output = '';

//Division Card
while( have_rows( 'division_right_rail' ) ) {
  the_row();
  $who_served = get_sub_field('division_who_served');
  $expertise  = get_sub_field('division_expertise');
}

$division_card   = array(
  'capabilities' => get_field('division_capabilities'),
  'who_served'   => $who_served,
  'expertise'    => $expertise,
  'logo'         => get_field('division_logo')
);

$output .= ll_include_component(
  'division-card',
  $division_card,
  array(),
  true
);

//Innovations Card
while( have_rows( 'innovation_right_rail' ) ) {
  the_row();
  $who_served     = get_sub_field('innovation_who_served');
  $past_projects  = get_sub_field('innovation_past_projects');
  $services       = get_sub_field('innovation_capability_services');
  $process        = get_sub_field('innovation_project_process');
}
while( have_rows( 'innovation_left_rail' ) ) {
  the_row();
  $capabilites    = get_sub_field('innovation_capabilities');
  $related        = get_sub_field('innovation_related');
  $leader_btn     = get_sub_field('innovation_leadership_btn');
  $timeline_btn   = get_sub_field('innovation_timeline_btn');
  $case_btn       = get_sub_field('innovation_case_studies_btn');
}

$innovation_card   = array(
  'capabilities'  => $capabilites,
  'innovations'   => $related,
  'who_served'    => $who_served,
  'past_projects' => $past_projects,
  'services'      => $services,
  'process'       => $process,
  'logo'          => get_field('division_logo'),
  'leader_btn'    => $leader_btn,
  'timeline_btn'  => $timeline_btn,
  'case_btn'      => $case_btn
);

$output .= ll_include_component(
  'innovation-card',
  $innovation_card,
  array(),
  true
);

//Image w/ Blockquote
$callout_img = array(
  'quote' => get_field('quote'),
  'cite'     => get_field('cite'),
  'background'   => get_field('background')
);

$output .= ll_include_component(
  'callout-image',
  $callout_img,
  array(),
  true
);

//Callout w/ Counter
while( have_rows( 'callout_numbers_columns' ) ) {
  the_row();
  $cols = get_field('callout_numbers_columns');
}

$callnums = array(
  'has_counting' => get_field('has_counting'),
  'headline'     => get_field('callout_numbers_headline'),
  'big_prefix'   => get_field('callout_numbers_prefix'),
  'big_number'   => get_field('callout_numbers'),
  'big_suffix'   => get_field('callout_numbers_suffix'),
  'subheadline'  => get_field('callout_numbers_subheadline'),
  'columns'      => $cols
);

$output .= ll_include_component(
  'callout-numbers',
  $callnums,
  array(),
  true
);

//Headline
$headline   = array(
  'text'      => get_field('headline_text'),
  'tag'       => get_field('headline_tag'),
  'colspan'   => get_field('headline_colspan')
);

$output .= ll_include_component(
  'headline',
  $headline,
  array(),
  true
);

//Logo Grid
$logo_grid   = array(
  'headline'      => get_field('logo_grid_headline'),
  'subheadline'       => get_field('logo_grid_subheadline'),
  'logos'   => get_field('logo_grid_content')
);

$output .= ll_include_component(
  'logo-grid',
  $logo_grid,
  array(),
  true
);

// Media Box
$cols = [];

while( have_rows( 'mediabox_columns' ) ) {
  the_row();
  $cols[] = array(
    'mediabox_bg'           => get_sub_field('mediabox_bg'),
    'mediabox_button'       => get_sub_field('mediabox_button'),
    'mediabox_button_style' => get_sub_field('mediabox_button_style'),
    'mediabox_headline'     => get_sub_field('mediabox_headline'),
    'mediabox_subheadline'  => get_sub_field('mediabox_subheadline'),
    'mediabox_content'      => get_sub_field('mediabox_content'),
    'mediabox_type'         => get_sub_field('mediabox_type'),
    'hero_gallery'          => array(
      'hero_gallery_image'  => get_sub_field('hero_gallery_image')
    ),
    'hero_video'            => get_sub_field('hero_video')
  );
}

$media   = array(
  'padded_top'        => get_sub_field('padded_top'),
  'padded_bottom'     => get_sub_field('padded_bottom'),
  'mediabox_columns'  => $cols
);

$output .= ll_include_component(
  'media-box',
  $media,
  array(
    'id' => $id
  ),
  true
);

//Band
$cols = [];

while( have_rows( 'band_columns' ) ) {
  the_row();

  $id = get_field('target_name');
  if( !$id ) $id = get_sub_field('target_name');

  $cols[] = array(
    'band_colspan'  => get_sub_field('band_colspan'),
    'band_bg'       => get_sub_field('band_bg'),
    'band_align'    => get_sub_field('band_align'),
    'column_button' => get_sub_field('column_button'),
    'button_style'  => get_sub_field('column_btn_style'),
    'button_icon'   => get_sub_field('column_btn_icon'),
    'band_content'  => get_sub_field('band_content')
  );
}

$band   = array(
  'has_background' => get_sub_field('has_background'),
  'navbar'         => get_sub_field('navbar'),
  'section_bg'     => get_sub_field('section_bg'),
  'band_theme'     => get_sub_field('band_theme'),
  'padded_top'     => get_sub_field('padded_top'),
  'padded_bottom'  => get_sub_field('padded_bottom'),
  'band_columns'   => $cols
);


//Vertical Timeline
$cols = [];

while( have_rows( 'vertical_timeline_columns' ) ) {
  the_row();

  $id = get_field('target_name');
  if( !$id ) $id = get_sub_field('target_name');

  $cols[] = array(
    'headline'  => get_sub_field('vertical_timeline_headline'),
    'content'   => get_sub_field('vertical_timeline_content'),
  );
}

$vertical_timeline   = array(
  'columns'   => $cols
);

$output .= ll_include_component(
  'vertical-timeline',
  $vertical_timeline,
  array(
   'id'      => $id
  ),
  true
);
echo $output;
?>
<section id="accordions" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h2>The Accordion</h2>
    </div>
    <div class="col col-xs-6of12 col-sm-8of12 col-md-8of12 col-lg-8of12">
      <p>Highlight any one of the divisions, its capabilities, innovations and case studies.</p>
    </div>
  </div>
</section>
<?php
$accordions = [
  'accordion_background' => get_field('accordion_background'),
  'accordion_wrapper'    => get_field('accordion_wrapper')
];

ll_include_component(
  'accordion',
  $accordions,
  array(
    'id' => $id
  )
);
?>
<section id="gallery" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h2>The Slideshow Gallery</h2>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <p>Showcase your a single large "hero" image with navigation. Navigation is automatically created below and contains:</p>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <ul>
        <li>Numbers: A visual element indicating the current slide (left) and the total number of slides (right)</li>
        <li>Progress: A thin horizontal bar indicating how many slides are left to view. It does this automatically.</li>
        <li>Arrows: Standard fare, clicking them takes you through the slides</li>
      </ul>
    </div>
  </div>
</section>
  <?php
    $gallery = get_field('gallery');

    ll_include_component(
      'gallery',
      array(
        'gallery' => $gallery
      ),
      array(
        'is_hero'    => false,
        'nav_id'     => uniqid($id.'-'),
        'id'         => $id
      )
    );
  ?>
<section id="masonry" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h2>The Masonry Gallery</h2>
    </div>
    <div class="col col-xs-6of12 col-sm-8of12 col-md-8of12 col-lg-8of12">
      <p>Showcase your images in a card-like grid. The option "Left" steps the images down from the top-left corner (highest), to the lower right corner (lowest). The option "Right" reverses this visual. Lastly, "Center" shows the images in the classic 3-up fashion.</p>
    </div>
  </div>
</section>
  <?php
  ll_include_component(
    'gallery-masonry',
    array(
      'gallery' => get_field('gallery-masonry')
    ),
    array(
      'id'         => $id
    )
  );
  ?>
<section id="locations">
  <header class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h2>The Locations</h2>
    </div>
    <div class="col col-xs-6of12 col-sm-8of12 col-md-8of12 col-lg-8of12">
      <p>Show the Divisions in row, with an optional contact button. The contact button information can be found on the Division itself.</p>
    </div>
  </header>
  <?php
  //Location
  ll_include_component(
    'locations',
    array(
      'num_locations'   => get_field('num_locations'),
      'use_interations' => get_field('use_interations')
    ),
    array()
  );
  ?>
</section>