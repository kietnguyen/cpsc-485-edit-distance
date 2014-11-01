<?php

// PRINT OUT ORIGINAL STRINGS
function printStrings($str1, $str2){
  // PRINT PROBLEM WITH ALL UPPERCASE CHARACTERS
  echo('<div id="answer-problem">');
  echo("<strong>String 1:</strong> $str1 <br />");
  echo("<strong>String 2:</strong> $str2 <br />");
  echo('<br />');
  echo('</div>');
}

// PRINT OUT THE ALIGNMENT GRID TABLE
function printTable($arr_str1, $arr_str2, $score, $points) {
  echo('<table border="1px" table-layout="fixed">');
  
  // PRINT HEADER FIRST ROW, WHICH IS THE SECOND STRING INPUT
  echo('<tr>');
  echo('<td></td><td></td>');
  for ($i=0;$i<count($arr_str2);$i++){
    echo('<td><strong>'.$arr_str2[$i].'</strong></td>');
  }
  echo('</tr>');
  
  for ($r=0;$r<count($score);$r++){
    echo('<tr valign="bottom" height="24px">');
    
    // PRINT FIRST CELL OF EACH ROW, WHICH IS FIRST STRING INPUT
    if ($r > 0)
      echo('<td><strong>'.$arr_str1[$r-1].'</strong></td>');
    else echo("<td></td>");
    
    // PRINT ALIGNMENT GRID
    for ($c=0;$c<count($score[0]);$c++){
      if (in_array(array($r,$c),$points))
        echo('<td class="pathVertex"><div><strong>'.$score[$r][$c].'</strong></div></td>');
      else echo('<td>'.$score[$r][$c].'</td>');
    }
    echo('</tr>');
  }
  echo('</table>');
}

// PRINT OUT THE ALIGNMENT GRID TABLE WITH DIRECTION
function printTable2($arr_str1, $arr_str2, $score, $points, $direction) {
  echo('<table border=1px table-layout=fixed>');
  
  // PRINT HEADER FIRST ROW, WHICH IS THE SECOND STRING INPUT
  echo('<tr class="tableStrHorizon">');
  echo('<td class="tableStrVertical"></td><td></td>');
  for ($i=0;$i<count($arr_str2);$i++){
    echo('<td class="tableStr">'.$arr_str2[$i].'</td>');
  }
  echo('</tr>');
  
  for ($r=0;$r<count($score);$r++){
    echo('<tr>');
    
    // PRINT FIRST CELL OF EACH ROW, WHICH IS FIRST STRING INPUT
    if ($r > 0)
      echo('<td class="tableStr">'.$arr_str1[$r-1].'</td>');
    else echo("<td></td>");
    
    // PRINT ALIGNMENT GRID
    for ($c=0;$c<count($score[0]);$c++){
      $class_direction = '';
      switch ($direction[$r][$c]){
        case 'u':
          $class_direction = 'pathUp';
          break;
        case 'l':
          $class_direction = 'pathLeft';
          break;
        case 'd':
          $class_direction = 'pathDia';
          break;
      }
    
      if (in_array(array($r,$c),$points))
        echo('<td class="' . $class_direction . ' pathFinal"><div class="score scoreFinal">'.$score[$r][$c].'</div></td>');
      else echo('<td class="' . $class_direction . '"><div class="score">'.$score[$r][$c].'</div></td>');
    }
    echo('</tr>');
  }
  echo('</table>');
}


// PRINT ALIGNED STRINGS
function printAlignment($arr_str1, $arr_str2, $path){
  // INITIALIZE ALIGNED STRING AND INDEX VARIABLES
  $output1 = '';
  $output2 = '';
  $index1 = count($arr_str1)-1;
  $index2 = count($arr_str2)-1;
  
  // PROCESS ALIGNED STRINGS IN BACKWARD ORDER
  for ($i=0;$i<count($path);$i++){
    switch ($path[$i]){
      case 'd':
        $output1 .= $arr_str1[$index1];
        $output2 .= $arr_str2[$index2];
        $index1--;
        $index2--;
        break;
      case 'l':
        $output1 .= '_';
        $output2 .= $arr_str2[$index2];
        $index2--;
        break;
      case 'u':
        $output1 .= $arr_str1[$index1];
        $output2 .= '_';
        $index1--;
        break;
    }
  }
  
  // REVERSE STRING IN NORNAL ORDER
  $output1 = strrev($output1);
  $output2 = strrev($output2);
  
  // PRINT RESULT OUT TO CLIENT
  echo('<div class="alignment-answer">');
  echo('<strong>ALIGNMENT:</strong><br />');
  echo("$output1 <br />");
  echo("$output2 <br /><br />");
  echo('</div>');
}

?>