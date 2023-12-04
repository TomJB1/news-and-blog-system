<?php
function ChangeBlocks($text, $url)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE pages SET [blocks]=? WHERE [url]=?");
    $stmt->execute(array($text, $url));
}

function NewPage($url)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO pages (url) VALUES (?)");
    $stmt->execute(array($url));
}

echo 'write.php';
echo $article;

var_dump(GetBlocks($article));

?>