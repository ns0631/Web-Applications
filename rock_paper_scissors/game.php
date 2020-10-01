<!doctype html>
<?php
if (isset($_GET['name']) === TRUE) {
  $user_name = $_GET['name'];
  $moves = array('Rock', 'Paper', 'Scissors', 'Test');

  if (isset($_POST['logout']) === TRUE){
    $location = "Location: index.php";
    header($location);
    exit();
  }
  function check($computer, $human) {
    $win_lose = array('Rock' => 'Scissors', 'Scissors' => 'Paper', 'Paper' => 'Rock');
    if ($computer === $human) {
      return "Tie";
    }
    else if ($win_lose[$computer] === $human){
      return "You lose";
    }
    else if ($win_lose[$human] === $computer){
      return "You win";
    }
  }

  function test(){
    $output = '';
    $moves = array('Rock', 'Paper', 'Scissors');
    $win_lose = array('Rock' => 'Scissors', 'Scissors' => 'Paper', 'Paper' => 'Rock');
    for ($computer_index = 0; $computer_index < 3; $computer_index++){
      for ($user_index = 0; $user_index < 3; $user_index++){
        $computer_move = $moves[$computer_index];
        $user_move = $moves[$user_index];
        $result = check($computer_move, $user_move);
        $output .= "Human=$user_move Computer=$computer_move Result=$result\n";
      }
    }
    return $output;
  }

  if (isset($_POST['human']) !== TRUE || $_POST['human'] === '-1') {
    $output = 'Please select a strategy and press Play.';
  }
  else {
    $user_move = $moves[(int) $_POST['human']];
    if ($user_move === "Test") {
      $output = test();
    }
    else {
      $computer_move = $moves[rand(0, 2)];
      $result = check($computer_move, $user_move);
      $output = "Your Play=$user_move Computer Play=$computer_move Result=$result";
    }
  }
  $game_page = "game.php?name=$user_name";
}
else {
  die("Name parameter missing");
}
?>

<html lang="en">
  <head>
    <title>Nikhil Sunkad's Rock, Paper, Scissors Game</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="rules.css">
  </head>
  <body>
    <h1>Rock Paper Scissors</h1>
    <div class="container">
      <p>Welcome: <?= htmlentities($user_name) ?></p>
      <form style="margin-left:3em;" method="post" action="<?= $game_page?>">
        <select name="human">
          <option value="-1">Select</option>
          <option value="0">Rock</option>
          <option value="1">Paper</option>
          <option value="2">Scissors</option>
          <option value="3">Test</option>
        </select>
        <input type="submit" name="play" value="Play">
        <input type="submit" name="logout" value="Logout">
      </form>
      <pre><?= $output ?></pre>
    </div>
  </body>
</html>
