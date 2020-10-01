<!doctype html>
<html lang="en">
  <head>
    <title>Nikhil Sunkad Guessing Game</title>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>Welcome to my guessing game!</h1>
    <p>
      <?php
        $answer = 14;
        if (! isset($_GET['guess'])) {
          $output = "Missing guess parameter";
        }
        else {
          $guess = $_GET['guess'];
          $guess_length = strlen($guess);
          if ($guess_length == 0) {
            $output = "Your guess is too short";
          }
          elseif ($guess == 0 && $guess !== '0') {
            $output = "Your guess is not a number";
          }
          elseif ($guess == $answer) {
            $output = "Congratulations - You are right";
          }
          elseif ($guess > $answer) {
            $output = "Your guess is too high";
          }
          elseif ($guess < $answer) {
            $output = "Your guess is too low";
          }
        }

        echo $output;
        /*
        var_dump($_GET);
        $is_zero = $_GET['guess'] === '0';
        var_dump($is_zero);
        */
      ?>
    </p>
  </body>
</html>
