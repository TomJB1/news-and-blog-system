<?php
function InsertBlocks($text, $url)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE pages SET [blocks]=? WHERE [url]=?");
    $stmt->execute(array($text, $url));
}
InsertBlocks("hi", "/hi");
?>