<!doctype html>
<?php
session_start();
if (isset($_POST['cancel'])) {
  unset($_POST['cancel']);
  session_destroy();
  header('Location: index.php');
  return;
}
$correct_hash = hash('md5', 'XyZzy12*_php123');
if ( isset($_POST['email']) && isset($_POST['pass']) ) {
  unset($_SESSION['account']);
  $user_hash = hash('md5', 'XyZzy12*_' . $_POST['pass']);
  if (strlen($_POST['email']) > 0 && $user_hash === $correct_hash) {
    if ( strpos($_POST['email'], '@') ) {
      $_SESSION['name'] = $_POST['email'];
      error_log("Login success ".$_POST['email']);
      header('Location: view.php');
      return;
    }
    else {
      $_SESSION['error'] = 'Email must have an at-sign (@)';
      error_log("Login fail ".$_POST['email']." $user_hash");
      header('Location: login.php');
      return;
    }
  }
  else if (strlen($_POST['email']) === 0 || strlen($_POST['pass']) === 0){
    $_SESSION['error'] = '<p style="color:red;">User name and password are required</p>';
    error_log("Login fail ".$_POST['email']." $user_hash");
    header('Location: login.php');
    return;
  }
  else if ($correct_hash !== $user_hash) {
    error_log("Login fail ".$_POST['email']." $user_hash");
    $_SESSION['error'] = 'Incorrect password';
    header('Location: login.php');
    return;
  }
}
?>

<html lang="en">
  <head>
    <title>Nikhil Sunkad's Login Page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="rules.css">
  </head>
  <body style="background-color: #7FFFD4;">
    <h1 style="margin-left:2em; font-family:sans-serif;">Please Log In</h1>
    <?php
        if ( isset($_SESSION['error']) ) {
          echo('<p style="color:red">'.$_SESSION['error']."</p>\n");
          unset($_SESSION['error']);
        }
        if ( isset($_SESSION['success']) ) {
          echo('<p style="color:green">'.$_SESSION['success']."</p>\n");
          unset($_SESSION['success']);
        }
    ?>
    <form method="POST" action="login.php" style="margin-left:4em; font-family:sans-serif;">
      <p>User name: <input type="text" name="email" id="name" size="30"></p>

      <p>Password: <input type="password" name="pass" id="id_1723" size="30"></p>

      <input type="submit" value="Log In">
      <input type="submit" name="cancel" value="Cancel">
  </body>
</html>
