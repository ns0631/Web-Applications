<?php
session_start();
require_once 'pdo.php';
if (! isset($_SESSION['name'])) {
  die('ACCESS DENIED');
}
else {
  $head = '<h1 style="font-family:sans-serif;">Tracking Automobiles for '.$_SESSION['name'].'</h1>';
  if (isset($_POST['Cancel'])) {
    header('Location: index.php');
    return;
  }
  if (! isset($_POST['Add'])) {
    $rows = '';
  }
  else {
    if ( strlen($_POST['make']) === 0 || strlen($_POST['mileage']) === 0 || strlen($_POST['model']) === 0 || strlen($_POST['year']) === 0) {
      $warning = 'All values are required';
      $_SESSION['error'] = $warning;
      header('Location: add.php');
      return;
    }
    else {
      if (is_numeric($_POST['mileage']) && is_numeric($_POST['year'])) {
        $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage, model) VALUES ( :mk, :yr, :mi, :md)');
          $stmt->execute(array(
          ':mk' => htmlentities($_POST['make']),
          ':yr' => htmlentities($_POST['year']),
          ':mi' => htmlentities($_POST['mileage']),
          ':md' => htmlentities($_POST['model']) )
          );
        $_SESSION['success'] = 'Record added';
        header('Location: index.php');
        return;
      }
      else {
        $_SESSION['error'] = 'Mileage and year must be numeric';
        header('Location: add.php');
        return;
      }
    }
  }
}
?>
<html lang="en">
  <head>
    <title>Nikhil Sunkad's Automobile Tracker Page</title>
    <meta charset="utf-8">
  </head>
  <body style="font-family:sans-serif;">
    <?php
      echo($head);
      if(isset($_SESSION['error'])) {
        $message = '<p style="color:red;">'.$_SESSION['error']."</p>" ?? '';
        echo($message);
        unset($_SESSION['error']);
      }
    ?>
    <form method="post">
      <p>Make: <input type="text" name="make"></p>
      <p>Model: <input type="text" name="model"></p>
      <p>Year: <input type="text" name="year"></p>
      <p>Mileage: <input type="text" name="mileage"></p>
      <p><input type="submit" value="Add" name="Add"/>
      <input type="submit" value="Cancel" name="Cancel"/></p>
    </form>
  </body>
</html>
