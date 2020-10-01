<!doctype html>
<?php
function query($subject) {
  $today = date("Y/m/d");
  $key = 'd50057161f60480a8aa5c4be47fed7b9';
  $url = "https://newsapi.org/v2/everything?q=$subject&from=$today&to=$today&sortBy=date&language=en&apiKey=$key";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $fake = curl_exec($ch);
  $output = JSON.parse($fake);
  curl_close($ch);
  echo $output["status"];
}
?>
<html lang="en">
  <head>
    <title>News app!</title>
    <meta charset="utf-8">
  </head>
  <body>
    <?php
    query('iran');
    ?>
  <body>
</html>
