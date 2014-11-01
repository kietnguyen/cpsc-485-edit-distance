<?php
// TEST CASES
//editDistance(str_split('atatatat'), str_split('tatatata'));
// OUTPUT: (2) -> a t a t a t a t _ AND _ t a t a t a t a

//editDistance(str_split('aaattttt'), str_split('tttttaaa'));
// OUTPUT: (6) -> a a a t t t t t _ _ _ AND _ _ _ t t t t t a a a

//editDistance(str_split('aatttaat'), str_split('ttatatat'));
// OUTPUT: (4) -> a _ a t t t a a t AND t t a t a t a _ t

// MAIN FUNCTION: PROCESS AND PRINT OUTPUTS
function editDistance($arr_str1, $arr_str2){
  // CALCULATE SCORE, KEEP TRACK DIRECTION, AND STORE FINAL SCORE
  $score_direction_distance = solveEditDistance($arr_str1, $arr_str2);

  include_once('traceBack.php');
  $path_points = traceBack($score_direction_distance[1]);

  include_once('printSolution.php');

  // PRINT ALIGNMENT GRID
  //printTable($arr_str1, $arr_str2, $score_direction_distance[0],$path_points[1]);
  printTable2($arr_str1, $arr_str2, $score_direction_distance[0],$path_points[1], $score_direction_distance[1]);
  echo('<br />');

  // PRINT FINAL EDIT DISTANCE SCORE
  echo('<div class="alignment-answer"><strong>EDIT DISTANCE</strong> = '.$score_direction_distance[2].'</div>');
  echo('<br />');

  // PRINT FINAL ALIGNMENT STRINGS
  printAlignment($arr_str1, $arr_str2, $path_points[0]);
}

// CALCULATE SCORE, KEEP TRACK DIRECTION, AND FINAL SCORE
function solveEditDistance($arr_str1, $arr_str2){
  $score = array();
  $direction = array();

  $strlen1 = count($arr_str1);
  $strlen2 = count($arr_str2);

  // INITIALIZE GRID TABLE TOP ROW AND LEFTMOST COLUMN
  $score[0][0] = 0;
  $direction[0][0] = '';
  // --LEFTMOST COLUMN
  for ($r=1; $r<=$strlen1; $r++){
    $score[$r][0] = $r;
    $direction[$r][0] = 'u';
  }
  // --TOP ROW
  for ($c=1; $c<=$strlen2; $c++){
    $score[0][$c] = $c;
    $direction[0][$c] = 'l';
  }

  // CALCULATE EDIT DISTANCE GRID TABLE
  for ($r=1; $r<=$strlen1; $r++){
    for ($c=1; $c<=$strlen2; $c++){
      // --CALCULATE SCORES
      $scoreUp = $score[$r-1][$c] + 1;
      $scoreLeft = $score[$r][$c-1] + 1;
      $scoreDiag = $score[$r-1][$c-1] + ($arr_str1[$r-1] != $arr_str2[$c-1]);

      // --DIRECTION FOR EACH SCORE
      $minScore = min($scoreUp, $scoreLeft, $scoreDiag);
      //echo("$r - $c: $scoreUp $scoreLeft $scoreDiag (".$arr_str1[$r-1]." ? ".$arr_str2[$c-1].") <br />");
      $score[$r][$c] = $minScore;
      switch ($minScore){
        case ($scoreLeft):
        $direction[$r][$c] = 'l';
        break;
        case ($scoreUp):
        $direction[$r][$c] = 'u';
        break;
        case ($scoreDiag):
        $direction[$r][$c] = 'd';
        break;
      }
    }
  }

  // STORE FINAL SCORE
  $distance = $score[$strlen1][$strlen2];

  return array($score, $direction, $distance);
}
?>
