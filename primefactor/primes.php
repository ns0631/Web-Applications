<!doctype html>
<?php
include 'factoring.php';
if (! isset($_POST['user_number'])) {
  $result = '';
}
else{
  if (! is_numeric($_POST['user_number'])) {
    $result = '';
  }
  else {
    $number = (int) $_POST['user_number'];
    if ($number === 1){
      $result = "Prime factorization: 1<sup>1</sup>";
    }
    else {
      $factors = prime_factor($number);
      $factorization = '';
      $length = count($factors);
      $iteration = 0;

      foreach($factors as $k => $v) {
        $iteration += 1;
        $factorization .= "$k<sup>$v</sup>";
        if ($iteration !== $length){
          $factorization .= " &middot ";
        }
      }
      $result = "Prime factorization of $number: $factorization";
    }
  }
}
?>
<html lang="en">
  <head>
    <title>Prime-factoring application!</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="rules.css">
  </head>
  <body style="background-color: yellow;">
    <h1 align="center">Prime-factoring application!</h1>
    <form method="post" action="primes.php">
      <label for="number-box">Enter a number:</label>
      <input type="number" id="number-box" name="user_number" min="1"/><br>
      <input type="submit" name="submission" value="Submit">
    </form>
    <pre><?= $result ?></pre>
    <p><a href="index.php">Return to homepage</a></p>
  </body>
</html>
