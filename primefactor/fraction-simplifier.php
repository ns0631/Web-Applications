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

if (!isset($_POST['numerator']) || !isset($_POST['denominator']) || (strlen($_POST['numerator']) == 0) || (strlen($_POST['denominator']) == 0) ){
  $numerator = '';
  $denominator = '';
  $dash = '';
}
else {
  $first_number = (int) $_POST['numerator'];
  $second_number = (int) $_POST['denominator'];

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
  $dash = "<hr style=\"border: 1px solid white; width:3em; position: fixed; top:53%; left: 48%;\">";
  $numerator = $first_number / $numeric_gcd;
  $denominator = $second_number / $numeric_gcd;
}
?>
<html lang="en">
  <head>
    <title>Fraction simplifying application!</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="rules.css">
  </head>
  <body style="background-color: navy;">
    <div id="lcm-gcd" style="color: white;">
      <h1 align="center">Fraction simplifying application!</h1>
      <label for="fraction">Enter a number:</label>
      <form method="post" action="fraction-simplifier.php" id="fraction">
        <input type="number" id="numerator" name="numerator" min="1"/>
        </p><input type="number" id="denominator" name="denominator" min="1"/></p>

        <input type="submit" name="submission" value="Submit">
      </form>
      <pre style="border-style: solid; border-width: 5px; border-color: red; background-color: indianred;">
        <p style="font-family: monospace; position: fixed; top:45%; left: 50%;" align="center" id="numerator" class="fraction-comp"><?= $numerator ?></p>
        <p><?= $dash ?></p>
        <p style="font-family: monospace; position: fixed; bottom: 35%; left: 50%;" align="center" id="denominator" class="fraction-comp"><?= $denominator ?></p>
      </pre>
      <p><a href="index.php">Return to homepage</a></p>
    </div>
  </body>
</html>
