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

echo '<pre>' . print_r(get_defined_vars(), true) . '</pre>';

if(isset($_GET["page"]))
{
    var_dump($_POST);
    if(isset($_POST["newpage"]))
    {
        echo NewPage($_POST["newpage"]);
    }
    else if(isset($_POST["newblocks"]))
    {
        ChangeBlocks($_POST["newblocks"], $_GET["page"]);
        echo 'new';
    }
    else
    {
        echo Blocks2Html(json_decode(GetBlocks($_GET["page"])));
    }
}
?>