<?php
  // END WHEN THERE IS NO VALID SUBMISSION
  if ((!isset($_POST['str1'])) OR
      (!isset($_POST['str2']))){
    die();
  }

  $str1 = $_POST['str1'];
  $str2 = $_POST['str2'];
  
  if (empty($str1) OR empty($str2)) die("Your inputs need to have at least one character!");
  
  require_once('sanitize.php');
  
  // TRIM AND UPPERCASE INPUTS
  $str1 = strtoupper(trim(cleanInput($str1)));
  $str2 = strtoupper(trim(cleanInput($str2)));
  
  if (empty($str1) OR empty($str2)) die("Your input(s) contain prohibit characters! Please try others.");
  
  require_once('printSolution.php');
  
  // PRINT ORIGINAL PROBLEM
  printStrings($str1, $str2);
  
  // SPLIT STRING INTO ARRAY
  $arr_str1 = str_split($str1);
  $arr_str2 = str_split($str2);
  $probType = cleanInput($_POST['probType']);
  
  // DECIDE ACTION FOR PROBLEMS
  switch ($probType){
    default:
      include_once('editDistance.php');
      editDistance($arr_str1, $arr_str2);
      break;
  }
  
?>