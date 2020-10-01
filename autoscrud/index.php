<?php
session_start();
require 'pdo.php';
$sql = "SELECT * FROM misc.autos";
$information = $pdo->query($sql);
$rows = '<table style="width:30%; border: 1px solid black;">';
$rows .= '<tr style="border: 1px solid black;"><td style="border: 1px solid black;">Model</td><td style="border: 1px solid black;">Year</td><td style="border: 1px solid black;">Make</td><td style="border: 1px solid black;">Mileage</td><td style="border: 1px solid black;">Action</td></tr>';
$info = '';
while ($row = $information->fetch(PDO::FETCH_ASSOC)) {
  $info .= '<tr style="border: 1px solid black;"><td style="border: 1px solid black;">';
  $info .= $row['model'];
  $info .= '</td><td style="border: 1px solid black;">';
  $info .= $row['year'];
  $info .= '</td><td style="border: 1px solid black;">';
  $info .= $row['make'];
  $info .= '</td><td style="border: 1px solid black;">';
  $info .= $row['mileage'];
  $info .= '</td><td style="border: 1px solid black;">';
  $auto_id = $row['autos_id'];
  $info .= '<a href="edit.php?autos_id=' . $auto_id . '" style="color:blue;">Edit</a> / <a href="delete.php?autos_id=' . $auto_id . '" style="color:blue;">Delete</a>';
  $info .= "</td></tr>\n";
}
?>
<html lang="en">
  <head>
    <title>Nikhil Sunkad's Index Page</title>
    <meta charset="utf-8">
  </head>
  <body style="font-family:sans-serif;">
    <?php
      if(isset($_SESSION['success'])) {
        $message = '<p style="color:green;">'.$_SESSION['success']."</p>" ?? '';
        echo($message);
        unset($_SESSION['success']);
      }
      if (isset($_SESSION['success'])) {
        $first_message = '<p><a style="color:green;">'.$_SESSION['success'].'</a></p>';
        unset($_SESSION['success']);
      }
      else if (isset($_SESSION['error'])) {
        $first_message = '<p><a style="color:red;">'.$_SESSION['error'].'</a></p>';
        unset($_SESSION['error']);
      }
      else {
        $first_message = '';
      }
      echo($first_message);
    ?>
    <h1>Welcome to the Automobiles Database</h1>
    <?php
      if (! isset($_SESSION['name'])) {
        $message = '<p><a style="color:blue;" href="login.php">Please log in</a></p><p>Attempt to <a style="color:blue;" href="add.php">add data</a> without logging in</p>';
      }
      else {
        if ( strlen($info) === 0 ){
          $message = '<p>No rows found</p>';
        }
        else{
          $message = $rows.$info."</table>";
        }
        $message .= '<p><a style="color:blue;" href="add.php">Add New Entry</a></p><p><a style="color:blue;" href="logout.php">Logout</a></p>';
      }
      echo($message);
    ?>
  </body>
</html>
