<!doctype html>
<?php
session_start();
require 'pdo.php';
if (! isset($_SESSION['name'])) {
  die('Not logged in');
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
      <h1 style="margin-left:2em;">Automobiles</h1>
      <?php
        if ( isset($_SESSION['success']) ) {
          echo('<p style="color: green; margin-left:4em;">'.htmlentities($_SESSION['success'])."</p>\n");
          unset($_SESSION['success']);
          echo('<ul style="margin-left:4em;">'.$_SESSION['rows']."</ul>\n");
        }
      ?>
      <p style="margin-left:4em;"><a href="add.php">Add New</a> | <a href="logout.php">Logout</a></p>
    </div>
  </body>
</html>
