<?php

include 'setup/setup.php';

function ChangeBlocks($text, $url)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE pages SET [blocks]=? WHERE [url]=?");
    $stmt->execute(array($text, $url));
}

if(isset($_GET["page"]))
{
    if(isset($_POST["newblocks"]))
    {
        ChangeBlocks($_POST["newblocks"], $_GET["page"]);
    }
    else if(isset($_GET["getblocks"]))
    {
        echo GetAllTemplates();
    }
    else
    {
        echo Blocks2Html(json_decode(GetBlocks($_GET["page"])));
    }
}
?>