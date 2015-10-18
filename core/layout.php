<?php function shoelace_columns($columns) {
  $cols = (int)$columns;

  switch ($cols) {
    case 2:
      $width = 6;
      break;
    case 3:
      $width = 4;
      break;
    case 4:
      $width = 3;
      break;
  }
}

function shoelace_container() {
  if(of_get_option('container')=='flexible') {
    $container_class = 'container-fluid';
  } else {
    $container_class = 'container';
  }
  echo $container_class;
}