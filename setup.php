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
    return $stmt->fetch();
}

function Blocks2Html($blockarray, $editable=false)
{
    var_dump($blockarray);
    $html = "";
    $inline = "";
    if($editable)
    {
        $inline = "contenteditable";
    }
    foreach ($blockarray as $id => $block) {
        $filename = "templates/".$block[0].'.template';
        $file = fopen($filename, "r");
        $blockhtml = fread($file,filesize($filename));
        $html = $html."<div id='$block[0]' ".$inline.">".preg_replace_callback("/{([0-9])}/", 
        function($matches) use ($block)
        {
            var_dump($matches);
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