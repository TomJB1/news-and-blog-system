<?php

include 'setup.php';

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

if(isset($_GET["page"]))
{
    if(isset($_POST["newpage"]))
    {
        NewPage($_POST["newpage"]);
    }
    else if(isset($_POST["newblocks"]))
    {
        ChangeBlocks($_POST["newblocks"], $_GET["page"]);
    }
    else
    {
        echo Blocks2Html(json_decode(GetBlocks($_GET["page"])));
    }
}
?>