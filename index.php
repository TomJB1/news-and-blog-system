<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include 'setup/setup.php';
    ?>
<style>
    <?php
        include 'setup/reset.css';
        include 'themes/'.$pageinfo["theme"].'.css';
    ?>
</style>
<?php
include $interface;

?>
</body>
</html>