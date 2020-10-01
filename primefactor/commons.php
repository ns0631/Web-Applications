<?php
require 'factoring.php';
function common_multiple($common, $a1, $a2) {
  $a1_exp = 0;
  $a2_exp = 0;
  foreach($a1 as $k => $v) {
    if ($k === $common) {
      $a1_exp = $v;
      break;
    }
  }
  foreach($a2 as $k => $v) {
    if ($k === $common) {
      $a2_exp = $v;
      break;
    }
  }
  if ($a2_exp > $a1_exp) {
    $number = pow($common, $a1_exp);
  }
  else {
    $number = pow($common, $a2_exp);
  }
  return $number;
}
function lcm_gcd($first_number, $second_number) {
  $factors = array();
  $first_factors = prime_factor($first_number);
  $factors = array();
  $second_factors = prime_factor($second_number);
  $factors = array();

  $common_factors = array();
  $numeric_gcd = 1;
  foreach($first_factors as $k1 => $v1) {
    foreach($second_factors as $k2 => $v2) {
      $common_number = common_multiple($k1, $first_factors, $second_factors);
      $numeric_gcd *= $common_number;
    }
  }
  $numeric_lcm = $first_number * $second_number / $numeric_gcd;
  $info = array("GCD" => $numeric_gcd, "LCM" => $numeric_lcm);
  var_dump($first_factors);
  var_dump($second_factors);
  return $info;
}
?>
