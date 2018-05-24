<?php
$members   = array(
  'num_members' => get_sub_field('num_members'),
);

ll_include_component(
  'leader-grid',
  $members,
  array(
    'classes' => 'ebony enter'
  )
);
?>