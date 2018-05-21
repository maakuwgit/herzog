<?php
//Setup our variables
$id = false;
$output = '';
?>
<article id="callout-numbers" class="content">
  <div class="container row start">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-3of12 col-lg-2of12 center">
      <h3>Headline</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-9of12 col-lg-10of12 center">
      <p>Select a heading tag and drop in some text. Easy!</p>
    </div>
  </div>
</article>
<?php
$headline   = array(
  'text'      => get_field('headline_text'),
  'tag'       => get_field('headline_tag'),
  'colspan'   => get_field('headline_colspan')
);

ll_include_component(
  'headline',
  $headline,
  array(
    'classes' => 'enter'
  )
);
?>
<article id="callout-numbers" class="content">
  <div class="container row start">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-3of12 col-lg-2of12 center">
      <h3>Band</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-5of12 col-md-6of12 col-lg-7of12 center">
      <p>By far the most used and useful component. A band has up to 6 adjustable columns. When you add a column, you will have the following options to acheive the desired look</p>
    </div>
  </div>
</article>
<?php
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
  'article_bg'     => get_sub_field('article_bg'),
  'band_theme'     => get_sub_field('band_theme'),
  'padded_top'     => get_sub_field('padded_top'),
  'padded_bottom'  => get_sub_field('padded_bottom'),
  'band_columns'   => $cols
);

ll_include_component(
  'band',
  $band,
  array(
    'classes' => 'enter',
    'id'  => $id
  )
);
?>
<article id="callout-numbers" class="content">
  <div class="container row start">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-3of12 col-lg-3of12 center">
      <h3>Logo Grid</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-8of12 col-md-9of12 col-lg-9of12 center">
      <p class="h5">Display your logos 4-up (2-up tablet / 1-up mobile)</p>
    </div>
  </div>
</article>
<?php
$logo_grid   = array(
  'headline'      => get_field('logo_grid_headline'),
  'subheadline'       => get_field('logo_grid_subheadline'),
  'logos'   => get_field('logo_grid_content')
);

$output .= ll_include_component(
  'logo-grid',
  $logo_grid,
  array(
    'classes' => 'enter'
  )
);
?>
<aside class="content" id="specialized">
  <div class="container row">
    <h2 class="block">Specialized</h2>
    <p class="h5 text-center">These components are sparsely used, or used only on one Page in the site.</p>
  </div>
</aside>
<article id="callout-numbers" class="content">
  <div class="container row start">
    <div class="col col-xs-6of12 col-sm-2of12 col-md-3of12 col-lg-3of12 center">
      <h3>Media Box</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-5of12 col-lg-5of12 center">
      <p>Display 2 Videos, 2 Slideshows or 1 Slideshow / 1 Slideshow with this component. Used originally on the page Home</p>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12 center">
      <ul>
        <li>Slideshows display navigation below the imagery</li>
        <li>An optional button appears below the content*</li>
      </ul>
      <small class="ivory">*best used with a video, where there is no navigation</small>
    </div>
  </div>
</article>
<?php
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

ll_include_component(
  'media-box',
  $media,
  array(
    'classes' => 'enter',
    'id' => $id
  )
);
?>
<article id="callout-numbers" class="content">
  <div class="container row start">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12 center">
      <h3>A Callout with Counting&nbsp;Numbers</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12 center">
      <p>If you'd like to showcase a large number statistic, this is the way to go.</p>
    </div>
  </div>
</article>
<?php
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

ll_include_component(
  'callout-numbers',
  $callnums,
  array(
    'classes' => 'enter'
  )
);
?>
<article id="testimonial" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12 center">
      <h3>The Testimonial Slider</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-8of12 col-md-8of12 col-lg-8of12 center">
      <p>Showcase your Testimonials in the same card-like grid as a Gallery w/ Image</p>
    </div>
  </div>
</article>
  <?php
  ll_include_component(
    'testimonial-grid',
    array(
      'num_testimonials' => get_field('num_testimonials')
    ),
    array(
    'classes' => 'enter',
    'id'      => $id
    )
  );
  ?>
<article id="callout-numbers" class="content">
  <div class="container row start">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12 center">
      <h3>Vertical Timeline</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12 center">
      <p class="h5 text-center">The most used components, these are here to plug in regular text, images, lists and anything else you'd like to organize in columns or rows.</p>
    </div>
  </div>
</article>
<?php
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

ll_include_component(
  'vertical-timeline',
  $vertical_timeline,
  array(
   'classes' => 'enter',
   'id'      => $id
  )
);
?>
<aside class="content" id="general">
  <div class="container row">
    <h2 class="block">General</h2>
    <p class="h5 text-center">The most used components, these are here to plug in regular text, images, lists and anything else you'd like to organize in columns or rows.</p>
  </div>
</aside>
<article id="capability_teaser" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h3>The Capability Teaser</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <p>Based on the "Band" component, this is 2-up/2 column layout with an image on the left and text on the right. There are 2 ways to create a teaser.</p>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <ul>
        <li>If we are going to use an existing "Capability", it can be selected from the dropdown</li>
        <li>Conversely, you we can create a new capability for use on a single page. This addition will NOT be added to the "Capabilities" post type.</li>
      </ul>
    </div>
  </div>
</article>
<?php
//Capability Teaser
$teaser = get_field('teaser_columns');

ll_include_component(
  'capability-teaser',
  array(
    'teaser_columns' => $teaser
  ),
  array(
    'classes' => 'enter',
    'id'      => $id
  )
);
?>
<aside class="content" id="images">
  <div class="container row">
    <h2 class="block">Imagery</h2>
    <p class="h5 text-center">Whether you're looking for a slideshow, a grid or simply a single image with some padding around it, we've provided several options for images.</p>
  </div>
</aside>
<article id="accordions" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h3>The Big Image</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-8of12 col-md-8of12 col-lg-8of12">
      <p>It's just a big image with an equal amount of padding above and below.</p>
    </div>
  </div>
</article>
<?php
  //Big Image
  ll_include_component(
    'picture',
    array(
      'image' => get_field('big_image')
    ),
    array(
    'classes' => 'enter',
    'id'      => $id
    )
  );
?>
<article id="callout_img" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h3>Image with a Blockquote</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-8of12 col-md-8of12 col-lg-8of12">
      <p>This one is SUPER simple. It's just an image of your choice with some text over it. There is a field for the quote itself, and one for a credit or "cite/citation".</p>
    </div>
  </div>
</article>
<?php
  //Image w/ Blockquote
  $callout_img = array(
    'quote' => get_field('quote'),
    'cite'     => get_field('cite'),
    'background'   => get_field('background')
  );

  ll_include_component(
    'callout-image',
    $callout_img,
    array(
    'classes' => 'enter',
    'id'      => $id
    )
  );
?>
<article id="gallery" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h3>The Slideshow Gallery</h3>
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
</article>
  <?php
    $gallery = get_field('gallery');

    ll_include_component(
      'gallery',
      array(
        'gallery' => $gallery
      ),
      array(
        'classes'    => 'enter',
        'is_hero'    => false,
        'nav_id'     => uniqid($id.'-'),
        'id'         => $id
      )
    );
  ?>
<article id="masonry" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12 center">
      <h3>The Masonry Gallery</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-8of12 col-md-8of12 col-lg-8of12 center">
      <p>Showcase your images in a card-like grid. The option "Left" steps the images down from the top-left corner (highest), to the lower right corner (lowest). The option "Right" reverses this visual. Lastly, "Center" shows the images in the classic 3-up fashion.</p>
    </div>
  </div>
</article>
  <?php
  ll_include_component(
    'gallery-masonry',
    array(
      'gallery' => get_field('gallery-masonry')
    ),
    array(
      'classes'    => 'enter',
      'id'         => $id,
      'cascade'    => get_field('cascade')
    )
  );
  ?>
<article id="gallery-w-copy" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12 center">
      <h3>A Gallery with Image and Copy</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-8of12 col-md-8of12 col-lg-8of12 center">
      <p>Showcase your images in a card-like grid, only in this version you can showcase a headline and copy beneath each image.</p>
    </div>
  </div>
</article>
  <?php
  ll_include_component(
    'gallery-w-copy',
    array(
      'gallery' => get_field('gallery-w-copy')
    ),
    array(
    'classes' => 'enter',
    'id'      => $id
    )
  );
  ?>
<aside class="content" id="cards">
  <div class="container row">
    <h2 class="block">Cards</h2>
    <p class="h5 text-center">A way to pull information for other, related areas into a Single Page. There is a card for the 3 major custom post types, Capability, Innovation and Division.</p>
  </div>
</aside>
<article id="gallery" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h3>The Capability Card</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <p>Visible on all Single "Capability" pages, this component pulls the related information and displays it in a postcard format. Optional information is as follows:</p>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <ul>
        <li>Related Division: pulls in said division's logo</li>
        <li>Related Innovation(s): Will display that innovation's name or multiple names.</li>
        <li>Remaining fields are open text fields where information can be pasted.<br><small class="danger">*Please note HTML information entered will be ignored. Line breaks can be put in without code</small></li>
        <li>The button links are all the same, and will populate automatically</li>
      </ul>
    </div>
  </div>
</article>
<?php
  while( have_rows( 'capability_right_rail' ) ) {
    the_row();
    $who_served     = get_sub_field('capability_who_served');
    $past_projects  = get_sub_field('capability_past_projects');
    $services       = get_sub_field('capability_services');
    $process        = get_sub_field('capability_project_process');
  }
  while( have_rows( 'capability_left_rail' ) ) {
    the_row();
    $capabilites    = get_sub_field('capability_related_capabilities');
    $related        = get_sub_field('capability_related_innovation');
    $leader_btn     = get_sub_field('capability_leadership_btn');
    $timeline_btn   = get_sub_field('capability_timeline_btn');
    $case_btn       = get_sub_field('capability_case_studies_btn');
  }

  $capability_card   = array(
    'capabilities'  => $capabilites,
    'innovations'   => $related,
    'who_served'    => $who_served,
    'past_projects' => $past_projects,
    'services'      => $services,
    'process'       => $process,
    'logo'          => get_field('division_logo_reversed'),
    'leader_btn'    => $leader_btn,
    'timeline_btn'  => $timeline_btn,
    'case_btn'      => $case_btn
  );

  ll_include_component(
    'capability-card',
    $capability_card,
    array(
    'classes' => 'enter',
    'id'      => $id
    )
  );
?>
<article id="division_card" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h3>The Division Card</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <p>Just like the "Capability Card", only visible while on Single "Division" pages. Most of the options are the same, only there are fewer of them.</p>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <ul>
        <li>Related Division: pulls in said division's logo</li>
        <li>Related Innovation(s): Will display that innovation's name or multiple names.</li>
        <li>Remaining fields are open text fields where information can be pasted.<br><small class="danger">*Please note HTML information entered will be ignored. Line breaks can be put in without code</small></li>
        <li>The button links are all the same, and will populate automatically</li>
      </ul>
    </div>
  </div>
</article>
<?php
  while( have_rows( 'division_right_rail' ) ) {
    the_row();
    $who_served = get_sub_field('division_who_served');
    $expertise  = get_sub_field('division_expertise');
  }

  $division_card   = array(
    'capabilities' => get_field('division_capabilities'),
    'who_served'   => $who_served,
    'expertise'    => $expertise,
    'logo'         => get_field('division_logo_reversed')
  );

  ll_include_component(
    'division-card',
    $division_card,
    array(
    'classes' => 'enter',
    'id'      => $id
    )
  );
  ?>
<article id="innovation_card" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h3>The Innovation Card</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <p>Just like the "Capability Card", only visible while on Single "Innovation" pages. Most of the options are the same, only there are fewer of them.</p>
    </div>
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <ul>
        <li>Related Division: pulls in said division's logo</li>
        <li>Related Innovation(s): Will display that innovation's name or multiple names.</li>
        <li>Remaining fields are open text fields where information can be pasted.<br><small class="danger">*Please note HTML information entered will be ignored. Line breaks can be put in without code</small></li>
        <li>The button links are all the same, and will populate automatically</li>
      </ul>
    </div>
  </div>
</article>
<?php
  while( have_rows( 'innovation_right_rail' ) ) {
    the_row();
    $purpose     = get_sub_field('innovation_purpose');
    $industries  = get_sub_field('innovation_industries');
  }
  while( have_rows( 'innovation_left_rail' ) ) {
    the_row();
    $capabilites    = get_sub_field('innovation_capabilities');
    $related        = get_sub_field('innovation_related');
  }

  $innovation_card   = array(
    'capabilities'  => $capabilites,
    'innovations'   => $related,
    'purpose'       => $purpose,
    'industries'    => $industries,
    'logo'          => get_field('division_logo_reversed')
  );

  ll_include_component(
    'innovation-card',
    $innovation_card,
    array(
    'classes' => 'enter',
    'id'      => $id
    )
  ); ?>
<aside class="content" id="misc">
  <div class="container row">
    <h2 class="block">Misc.</h2>
    <p class="h5 text-center">There are a few special-use components that are either rarely used, or are global components used in multiple ways.</p>
  </div>
</aside>
<article id="accordions" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h3>The Accordion</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-8of12 col-md-8of12 col-lg-8of12">
      <p>Highlight any one of the divisions, its capabilities, innovations and case studies.</p>
    </div>
  </div>
</article>
<?php
$accordions = [
  'accordion_background' => get_field('accordion_background'),
  'accordion_wrapper'    => get_field('accordion_wrapper')
];

ll_include_component(
  'accordion',
  $accordions,
  array(
  'classes' => 'enter',
  'id'      => $id
  )
);
?>
<article id="locations" class="content">
  <div class="container row">
    <div class="col col-xs-6of12 col-sm-4of12 col-md-4of12 col-lg-4of12">
      <h3>The Locations</h3>
    </div>
    <div class="col col-xs-6of12 col-sm-8of12 col-md-8of12 col-lg-8of12">
      <p>Show the Division location information in row, with an optional contact button. The contact button information can be found on the Division itself.</p>
      <p>The Locations are the only component NOT wrapped in an article or section. Because of this their width flexes to fill the box you put them in (Don't worry, you don't have to worry about any of that)</p>
    </div>
  </div>
</article>
<section class="content">
  <?php
  //Location
  ll_include_component(
    'locations',
    array(
      'num_locations'   => get_field('num_locations'),
      'use_interations' => get_field('use_interations')
    ),
    array(
    'classes' => 'enter',
    'id'      => $id
    )
  );
  ?>
</section>
<?php
  $links = get_field('relationships');

  ll_include_component(
    'related-nav',
    array(
      'links' => $links
    )
  );
?>