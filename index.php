<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body id="page">
<?php
include 'setup.php';

if(preg_match('/(?<interface>(write)|(config))(?<article>.*)/', $page, $matches))
{
    $article = $matches["article"];
    include $matches["interface"].'.php';
}
else
{
    include 'page.php';
}
?>
</body>
</html>