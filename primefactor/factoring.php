<?php
function is_prime($integer){
  $prime = TRUE;
  $half = floor($integer / 2);
  if ($integer === 1){
    $prime = FALSE;
  }
  else {
    for ($i = 2; $i <= $half; $i ++) {
      if ($integer % $i === 0) {
        $prime = FALSE;
        break;
      }
    }
  }
  return $prime;
}
$factors = array();
function prime_factor($integer) {
  global $factors;
  $half = ceil($integer);
  for ($i = 1; $i <= $half; $i ++) {
    if ($integer % $i === 0 && is_prime($i)) {
      if (isset($factors[$i])) {
        $factors[$i] += 1;
      }
      else {
        $factors[$i] = 1;
      }
      $new_int = (int) $integer / $i;
      prime_factor($new_int);
      break;
    }
  }
  return $factors;
}
?>
