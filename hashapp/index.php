<!doctype html>
<html lang="en">
  <head>
    <title>Nikhil Sunkad PHP</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>Nikhil Sunkad PHP</h1>
    <?php
    print "The SHA256 hash of \"Nikhil Sunkad\" is ";
    print hash('sha256', 'Nikhil Sunkad');
    ?>
    <pre>
<?php
echo "ASCII ART:";
    echo "\n
    *         *
    * *       *
    *   *     *
    *     *   *
    *       * *
    *         *";
?>
    </pre>
    <a href='./check.php'>Click here to check the error setting</a>
    <br>
    <a href='./fail.php'>Click here to cause a traceback</a>
  </body>
</html>
