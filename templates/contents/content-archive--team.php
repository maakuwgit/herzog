<?php
$cat = get_queried_object();
$members   = array(
  'num_members' => get_field('num_members', 'options'),
);

ll_include_component(
  'leader-grid',
  $members,
  array(
    'classes' => 'ebony enter'
  )
);
?>