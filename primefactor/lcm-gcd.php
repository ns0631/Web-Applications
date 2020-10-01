<?php
include 'factoring.php';
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

if (!isset($_POST['number_one']) || !isset($_POST['number_two']) ){
  $lcm = '';
  $gcd = '';
}
else {
  $first_number = (int) $_POST['number_one'];
  $second_number = (int) $_POST['number_two'];

  $factors = array();
  $first_factors = prime_factor($first_number);
  $factors = array();
  $second_factors = prime_factor($second_number);
  $factors = array();

  $common_factors = array();
  $numeric_gcd = 1;
  foreach($first_factors as $k1 => $v1) {
    $common_number = common_multiple($k1, $first_factors, $second_factors);
    $numeric_gcd *= $common_number;
  }
  $numeric_lcm = $first_number * $second_number / $numeric_gcd;
  $lcm = "LCM: $numeric_lcm";
  $gcd = "GCD: $numeric_gcd";
}
?>
<html lang="en">
  <head>
    <title>LCM/GCD application!</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="rules.css">
  </head>
  <body style="background-color: green;">
    <div id="lcm-gcd" style="color: white;">
      <h1 align="center">LCM/GCD application!</h1>
      <form method="post" action="lcm-gcd.php">
        <label for="number-one">Enter a number:</label>
        <input type="number" id="number-one" name="number_one" min="1"/>

        <p><label for="number-two">Enter another number:</label>
        <input type="number" id="number-two" name="number_two" min="1"/></p>

        <input type="submit" name="submission" value="Submit">
      </form>
      <pre>
        <p style="font-family: monospace;"><?= $lcm ?></p>
        <p style="font-family: monospace;"><?= $gcd ?></p>
      </pre>
      <p><a href="index.php">Return to homepage</a></p>
    </div>
  </body>
</html>
