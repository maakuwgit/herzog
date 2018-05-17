<?php
if( have_rows( 'components' ) ) {
  $output = '';

  while( have_rows( 'components' ) ) {
    the_row();
    $id = ( get_sub_field('target_name') ? get_sub_field('target_name') : false );

    switch( get_row_layout() ) {

      case 'bands' :
        $cols = [];

        while( have_rows( 'band_columns' ) ) {
          the_row();
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

        $output .= ll_include_component(
          'band',
          $band,
          array(
            'section' => get_sub_field('group_label'),
            'id' => $id
          ),
          true
        );
      break;
      case 'big-images':
        //Big Image
        $output .= ll_include_component(
          'picture',
          array(
            'image' => get_sub_field('big_image')
          ),
          array(
            'id' => $id
          ),
          true
        );
      break;
      case 'callout-images':
        //Image w/ Blockquote
        $callout_img = array(
          'quote' => get_sub_field('quote'),
          'cite'     => get_sub_field('cite'),
          'background'   => get_sub_field('background')
        );

        $output .= ll_include_component(
          'callout-image',
          $callout_img,
          array(
            'id' => $id
          ),
          true
        );
      break;
      case 'callout-numbers':
        //Callout w/ Counter
        $callnums = array(
          'has_counting' => get_sub_field('has_counting'),
          'headline'     => get_sub_field('callout_numbers_headline'),
          'big_prefix'   => get_sub_field('callout_numbers_prefix'),
          'big_number'   => get_sub_field('callout_numbers'),
          'big_suffix'   => get_sub_field('callout_numbers_suffix'),
          'subheadline'  => get_sub_field('callout_numbers_subheadline'),
          'columns'      => get_sub_field('callout_numbers_columns')
        );

        $output .= ll_include_component(
          'callout-numbers',
          $callnums,
          array(
            'id' => $id
          ),
          true
        );
      break;
      case 'capability-cards':
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

        $output .= ll_include_component(
          'capability-card',
          $capability_card,
          array(),
          true
        );
      break;
      case 'capability-teasers':
        //Capability Teaser
        $teaser = get_sub_field('teaser_columns');

        $output .= ll_include_component(
          'capability-teaser',
          array(
            'teaser_columns' => $teaser
          ),
          array(
            'id' => $id
          ),
          true
        );
      break;
      case 'divisions' :
        $accordions = [
          'accordion_background' => get_sub_field('accordion_background'),
          'accordion_wrapper'    => get_sub_field('accordion_wrapper')
        ];

        $output .= ll_include_component(
          'accordion',
          $accordions,
          array(
            'id' => $id
          ),
          true
        );
      break;
      case 'division-cards' :
        while( have_rows( 'division_right_rail' ) ) {
          the_row();
          $who_served = get_sub_field('division_who_served');
          $expertise  = get_sub_field('division_expertise');
        }

        $division_card   = array(
          'capabilities' => get_sub_field('division_capabilities'),
          'who_served'   => $who_served,
          'expertise'    => $expertise,
          'logo'         => get_field('division_logo_reversed')
        );

        $output .= ll_include_component(
          'division-card',
          $division_card,
          array(
            'id' => $id
          ),
          true
        );
      break;
      case 'galleries' :
        $slideshow = get_sub_field('gallery');

        $output .= ll_include_component(
          'gallery',
          array(
            'gallery' => $slideshow
          ),
          array(
            'is_hero'    => false,
            'is_fullwidth'  => get_sub_field('is_fullwidth'),
            'nav_id'     => uniqid($id.'-'),
            'id' => $id
          ),
          true
        );
      break;
      case 'headlines' :
        $headline   = array(
          'text'      => get_sub_field('headline_text'),
          'tag'       => get_sub_field('headline_tag'),
          'colspan'   => get_sub_field('headline_colspan')
        );

        $output .= ll_include_component(
          'headline',
          $headline,
          array(
            'id' => $id
          ),
          true
        );
      break;
      case 'innovation-cards' :
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

        $logo = get_field('use_division');
        if( !$logo ) {
          $logo = get_field('division_logo_reversed');
        }else{
          $logo = get_field('division_logo_reversed', $logo);
        }

        $innovation_card   = array(
          'capabilities'  => $capabilites,
          'innovations'   => $related,
          'purpose'       => $purpose,
          'industries'    => $industries,
          'logo'          => $logo
        );

        $output .= ll_include_component(
          'innovation-card',
          $innovation_card,
          array(),
          true
        );
      break;
      case 'locations' :
        //Since the Locations are used in the footer and other places as well, the markup for the section needs to be injected here
        $output .= '<section class="locations">';
        $output .= ll_include_component(
          'locations',
          array(
            'num_locations'   => get_sub_field('num_locations'),
            'use_interations' => get_sub_field('use_interations')
          ),
          array(
            'id' => $id
          ),
          true
        );
        $output .= '</section>';
      break;
      case 'logos-grid' :
        $logo_grid   = array(
          'headline'    => get_sub_field('logo_grid_headline'),
          'subheadline' => get_sub_field('logo_grid_subheadline'),
          'logos'       => get_sub_field('logo_grid_content')
        );

        $output .= ll_include_component(
          'logo-grid',
          $logo_grid,
          array(
            'id' => $id
          ),
          true
        );
      break;
      case 'masonry-galleries' :
        $output .= ll_include_component(
          'gallery-masonry',
          array(
            'gallery' => get_sub_field('gallery-masonry')
          ),
          array(
            'id'         => $id,
            'cascade'    => get_sub_field('cascade')
          ),
          true
        );
      break;
      case 'galleries-w-copy':
        $output .= ll_include_component(
          'gallery-w-copy',
          array(
            'gallery' => get_sub_field('gallery-w-copy')
          ),
          array(
            'id'         => $id
          ),
          true
        );
      break;
      case 'members' :
        $members   = array(
          'num_members' => get_sub_field('num_members'),
        );

        $output .= ll_include_component(
          'leader-grid',
          $members,
          array(
            'id' => $id
          ),
          true
        );
      break;
      case 'mediaboxes' :
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
      break;
      case 'vertical-timeline' :
        $cols = [];

        while( have_rows( 'vertical_timeline_columns' ) ) {
          the_row();

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
      break;
      default:
        the_content();
      break;
    }
  }
  echo $output;
}
?>