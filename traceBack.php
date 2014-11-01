<?php

// TRACE BACK ALIGNMENT PATH FROM DIRECTION GRID TABLE
function traceBack($direction){
  // INITIALIZE ROW AND COLUMN INDEX FROM BOTTOM RIGHT
  $r = count($direction)-1;
  $c = count($direction[0])-1;
  if (($r == 0) OR ($c == 0)) die("Error when tracing back vertices!");
  
  // INITIALIZE FOR ALIGNMENT PATH AND EACH POINTS OF THAT PATH
  $path = array();
  $points = array();

  // BACK TRACING
  while (($r > 0) AND ($c > 0)){
    array_push($points, array($r, $c));
    array_push($path, $direction[$r][$c]);
    switch ($direction[$r][$c]){
      case 'd':
        $r--;
        $c--;
        break;
      case 'l':
        $c--;
        break;
      case 'u':
        $r--;
        break;
    }
  }
  
  // HANDLING BACKTRACING WHEN AT BORDER
  // --AT LEFTMOST COLUMN
  if (($r > 0) AND ($c == 0)){
    for ($i=$r;$i>0;$i--){
      array_push($points, array($i, 0));
      array_push($path, 'u');
    }
  }
  // --AT TOP ROW
  if (($c > 0) AND ($r == 0)){
    for ($i=$c;$i>0;$i--){
      array_push($points, array(0, $i));
      array_push($path, 'l');
    }
  }
  array_push($points, array(0,0));
  /*
  echo('<pre>');
  print_r($path);
  //print_r($points);
  echo('</pre>');
  */
  return array($path, $points);
}

?>