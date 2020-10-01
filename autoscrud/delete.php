<?php
session_start();
require_once 'pdo.php';
if ( (! isset($_GET['autos_id']) ) || (strlen($_GET['autos_id']) === 0) ) {
  $carname = '';
  $_SESSION['error'] = 'Bad Id for value';
  header('Location: index.php');
  return;
}
else {
  if (isset($_POST['Delete'])) {
    $stmt = $pdo->prepare('DELETE FROM autos WHERE autos_id <= ?');
    $stmt->execute([$_GET['autos_id']]);
    unset($_POST['Delete']);
    $_SESSION['success'] = 'Record deleted';
    header("Location: index.php");
    return;
  }
  $stmt = $pdo->prepare("SELECT * FROM misc.autos WHERE autos_id <= ?");
  $stmt->execute([$_GET['autos_id']]);
  $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $carname = $arr[0]['make'];
}
?>
<html lang="en">
  <head>
    <title>Deleting...</title>
    <meta charset="utf-8">
  </head>
  <body style="font-family:sans-serif;">
    <p>Confirm: Deleting <?= $carname ?></p>
    <form method="post">
      <p><input type="submit" value="Delete" name="Delete"/><a href="index.php" style="color:blue;">Cancel</a></p>
    </form>
  </body>
</html>
