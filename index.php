<?php
$domain = $_SERVER['SERVER_NAME'];
$page = $_SERVER['REQUEST_URI'];
global $pdo;
$pdo = new  PDO("sqlite:databases/".$domain.".db");

function GetBlocks($url)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT [blocks] FROM pages WHERE [url]=?");
    $stmt->execute(array($url));
    return $stmt->fetch()[0];
}

echo $page;
echo GetBlocks("/hi");
?>