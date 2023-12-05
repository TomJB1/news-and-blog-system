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

function Blocks2Html($blockarray, $editable=false)
{
    $html = "";
    foreach ($blockarray as $id => $block) {
        $filename = "templates/".$block[0].'.template';
        $file = fopen($filename, "r");
        $blockhtml = fread($file,filesize($filename));
        $html = $html."<div id='$block[0]'>".preg_replace_callback("/{([0-9])}/", 
        function($matches) use ($block)
        {
            return $block[$matches[1]];
        },
        $blockhtml)."</div>";
    }
    return $html;
}

function Html2Blocks($html)
{

}
?>