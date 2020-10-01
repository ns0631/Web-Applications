<?php
session_start();
if (isset($_POST['login'])) {
  $real_password = hash('md5', 'XyZzy12*_php123');
  $user_password = hash('md5', 'XyZzy12*_'.$_POST['pass']);
  if ($real_password == $user_password && strlen($_POST['email']) > 0) {
    $_SESSION['name'] = $_POST['email'];
    header('Location: index.php');
    return;
  }
  else{
    if ( strlen($_POST['pass']) === 0 ) {
      $_SESSION['error'] = '<p style="color:red;">User name and password are required</p>';
      header('Location: login.php');
      return;
    }
    else if ( strlen($_POST['email']) === 0 ) {
      $_SESSION['error'] = '<p style="color:red;">User name and password are required</p>';
      header('Location: login.php');
      return;
    }
    else if ( $user_password != $real_password ){
      $_SESSION['error'] = '<p style="color:red;">Incorrect password</p>';
      header('Location: login.php');
      return;
    }
  }
}
?>
<html lang="en">
  <head>
    <title>Nikhil Sunkad's Login Page</title>
    <meta charset="utf-8">
  </head>
  <body style="font-family:sans-serif;">
    <h1>Please log in</h1>
    <?php
      $message = $_SESSION['error'] ?? '';
      echo($message);
      if(isset($_SESSION['error'])) {
        unset($_SESSION['error']);
      }
    ?>
    <form method="post">
      <p>User Name <input type="text" name="email"></p>
      <p>Password <input type="text" name="pass"></p>
      <input type="submit" name="login" value="Log In"/>
      <a style="color:blue;" href="index.php">Cancel</a>
    </form>
  </body>
</html>
