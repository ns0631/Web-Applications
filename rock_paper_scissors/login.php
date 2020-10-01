<!doctype html>
<?php
if (isset($_POST['cancel']) === TRUE){
  $location = "Location: index.php";
  header($location);
  exit();
}

$correct_hash = hash('md5', 'XyZzy12*_php123');
if (isset($_POST['who']) === TRUE && isset($_POST['pass']) === TRUE) {
  $user_hash = hash('md5', 'XyZzy12*_' . $_POST['pass']);
  if (strlen($_POST['who']) > 0 && $user_hash === $correct_hash) {
    header("Location: game.php?name=".urlencode($_POST['who']));
    exit();
  }
  else if (strlen($_POST['who']) === 0 || strlen($_POST['pass']) === 0){
    $warning = '<p style="color:red;">User name and password are required</p>';
  }
  else if (strlen($_POST['pass']) !== 'php123') {
    $warning = '<p style="color:red;">Incorrect password</p>';
  }
}
else {
  $warning = '';
}
?>

<html lang="en">
  <head>
    <title>Nikhil Sunkad's Login Page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="rules.css">
  </head>
  <body style="background-color: #7FFFD4;">
    <h1>Please Log In</h1>
    <p><?= $warning ?><p>
    <form method="POST" action="login.php" style="margin-left:3em;">
      <label for="nam">User Name</label>
      <input type="text" name="who" id="nam" size="30"><br/>

      <label for="id_1723">Password</label>
      <input type="password" name="pass" id="id_1723" size="30"><br/>

      <input type="submit" value="Log In">
      <input type="submit" name="cancel" value="Cancel">
  </body>
</html>
