<?php
session_start();
require_once 'pdo.php';
if ( (! isset($_GET['autos_id']) ) || (strlen($_GET['autos_id']) === 0) ) {
  $_SESSION['error'] = 'Bad Id for value';
  header('Location: index.php');
  return;
}
else {
  if (isset($_POST['Cancel'])) {
    header('Location: index.php');
    return;
  }
  else if ( isset($_POST['Save']) ) {
    unset($_POST['Save']);
    if ( strlen($_POST['make']) === 0 || strlen($_POST['mileage']) === 0 || strlen($_POST['model']) === 0 || strlen($_POST['year']) === 0) {
      $warning = 'All values are required';
      $_SESSION['error'] = $warning;
      header('Location: edit.php?autos_id='.$_GET['autos_id']);
      return;
    }
    else {
      if (is_numeric($_POST['mileage']) && is_numeric($_POST['year'])) {
        $auto_id = $_GET['autos_id'];
        $stmt = $pdo->prepare("UPDATE autos SET make = :mk WHERE autos_id=$auto_id");
        $stmt->execute( array(':mk' => htmlentities($_POST['make'])) );
        $stmt = $pdo->prepare("UPDATE autos SET year = :yr WHERE autos_id=$auto_id");
        $stmt->execute(array(':yr' => htmlentities($_POST['year'])) );
        $stmt = $pdo->prepare("UPDATE autos SET model = :md WHERE autos_id=$auto_id");
        $stmt->execute(array(':md' => htmlentities($_POST['model'])) );
        $stmt = $pdo->prepare("UPDATE autos SET mileage = :mi WHERE autos_id=$auto_id");
        $stmt->execute(array(':mi' => htmlentities($_POST['mileage'])) );
        $_SESSION['success'] = 'Record updated';
        header('Location: index.php');
        return;
      }
      else {
        $_SESSION['error'] = 'Mileage and year must be numeric';
        header('Location: edit.php?autos_id='.$_GET['autos_id']);
        return;
      }
    }
  }
  else {
    $sql = "SELECT * FROM misc.autos WHERE autos_id=".$_GET['autos_id'];
    $information = $pdo->query($sql);
    while ($row = $information->fetch(PDO::FETCH_ASSOC)) {
      $model = $row['model'];
      $year = $row['year'];
      $make = $row['make'];
      $mileage = $row['mileage'];
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
      if(isset($_SESSION['error'])) {
        $message = '<p style="color:red;">'.$_SESSION['error']."</p>" ?? '';
        echo($message);
        unset($_SESSION['error']);
      }
    ?>
    <h1>Editing Automobile</h1>
    <form method="post">
      <p>Make: <input type="text" name="make" value="<?= $make?>"/></p>
      <p>Model: <input type="text" name="model" value="<?= $model?>"/></p>
      <p>Year: <input type="text" name="year" value="<?= $year?>"/></p>
      <p>Mileage: <input type="text" name="mileage" value="<?= $mileage?>"/></p>
      <p><input type="submit" value="Save" name="Save"/>
      <input type="submit" value="Cancel" name="Cancel"/></p>
    </form>
  </body>
</html>
