<!doctype html>
<?php
session_start();
require 'pdo.php';
if (! isset($_SESSION['name'])) {
  die('Not logged in');
}
else{

}
if (isset($_POST['cancel'])) {
  header('Location: view.php');
}
if (! isset($_POST['Add'])) {
  $warning = '';
  $rows = '';
}
else {
  if ( strlen($_POST['make']) === 0 ) {
    $warning = 'Make is required';
    $_SESSION['error'] = $warning;
    $_SESSION['rows'] = "";
    header('Location: add.php');
  }
  else if ( strlen($_POST['mileage']) === 0 ) {
    $warning = 'Mileage is required';
    $_SESSION['error'] = $warning;
    $_SESSION['rows'] = "";
    header('Location: add.php');
  }
  else if ( strlen($_POST['year']) === 0 ) {
    $warning = 'Year is required';
    $_SESSION['error'] = $warning;
    $_SESSION['rows'] = "";
    header('Location: add.php');
  }
  else {
    if (is_numeric($_POST['mileage']) && is_numeric($_POST['year'])) {
      $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES ( :mk, :yr, :mi)');
        $stmt->execute(array(
        ':mk' => htmlentities($_POST['make']),
        ':yr' => htmlentities($_POST['year']),
        ':mi' => htmlentities($_POST['mileage']) )
        );
      $sql = "SELECT * FROM misc.autos";
      $information = $pdo->query($sql);
      $_SESSION['rows'] = '';
      while ($row = $information->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['rows'] .= "<li>";
        $_SESSION['rows'] .= $row['year'].' ';
        $_SESSION['rows'] .= $row['make'].' / ';
        $_SESSION['rows'] .= $row['mileage'];
        $_SESSION['rows'] .= "</li>\n";
      }
      $_SESSION['success'] = 'Record inserted';
      header('Location: view.php');
    }
    else {
      $_SESSION['error'] = 'Mileage and year must be numeric';
      $_SESSION['rows'] = '';
      header('Location: add.php');
    }
  }
}
?>
<html>
  <head>
    <title>Nikhil Sunkad's Automobile Tracker</title>
    <meta charset="utf-8">
  </head>
  <body style="background-color:lavender;">
    <div id="page" style="font-family:sans-serif;">
      <h1 style="margin-left:2em;">Tracking Autos for <?= htmlentities($_SESSION['name']) ?></h1>
      <?php
      $error_code = $_SESSION['error'] ?? '';
      echo('<p style="color: red; margin-left:4em;">'.$error_code."</p>");
      //unset($_SESSION['error']);
      ?>
      <form id="information" method="POST" style="margin-left:4em;">
        <p>Make: <input type="text" name="make"/></p>
        <p>Year: <input type="text" name="year"/></p>
        <p>Mileage: <input type="text" name="mileage"/></p>
        <input type="submit" name="Add" value="Add"/>
        <input type="submit" name="cancel" value="Cancel">
      </form>
    </div>
  </body>
</html>
