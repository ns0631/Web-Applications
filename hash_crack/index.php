<!doctype html>
<html>
  <head>
    <title>Nikhil Sunkad MD5 Hash Cracker</title>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>MD5 PIN Cracker</h1>

    <p>This application takes an MD5 hash of a four digit pin and checks all 10,000 possible four digit PINs to determine the correct PIN.</p>
    <pre>
Debug Output:
<?php
$pin = "PIN: Not found";
$found = FALSE;
$checks = 0;
if (isset($_GET['md5'])) {
  $time_pre = microtime(true);
  $user_request = $_GET['md5'];
  for ($a = 0; $a <= 9; $a++) {
    for ($b = 0; $b <= 9; $b++) {
      for ($c = 0; $c <= 9; $c++) {
        for ($d = 0; $d <= 9; $d++) {
          $checks += 1;
          $pin = '' . $a . $b . $c . $d;
          $hashed_pin = hash('md5', $pin);
          if ($pin < 15) {
            echo '' . $hashed_pin . ' ' . $pin . "\n";
          }
          if ($hashed_pin == $user_request){
            $found = TRUE;
            break;
          }
        }
        if ($found == TRUE){
          break;
        }
      }
      if ($found == TRUE){
        break;
      }
    }
    if ($found == TRUE){
      break;
    }
  }
  if ($found == TRUE) {
    $pin = "PIN: " . $pin;
  }
  else {
    $pin = "PIN: Not found";
  }
  $time_post = microtime(true);
  $elapsed = $time_post - $time_pre;
  echo "\nElapsed time: " . $elapsed . "\n";
  echo "Total checks: " . $checks;
}
else {
  echo "\n";
}
?>
    </pre>
    <p><?= htmlentities($pin); ?></p>
    <form method="get" action="http://localhost:8888/hash_crack/">
      <input type="text" name="md5" size="60"/>
      <input type="submit" value="Crack MD5"/>
    </form>
    <p><a href="http://localhost:8888/hash_crack/">Reset this page</a></p>
  </body>
</html>
