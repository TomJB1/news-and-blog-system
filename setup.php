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
    $html = "";
    $attributes = "";
    if($editable)
    {
        $attributes = "contenteditable";
    }
    foreach ($blockarray as $id => $block) {
        $filename = "templates/".$block[0].'.template';
        $file = fopen($filename, "r");
        $blockhtml = fread($file,filesize($filename));
        print_r($block);
        $html = $html."<div class='block' id='$block[0]'>".preg_replace_callback("/{([0-9])}/", 
        function($matches) use ($block, $attributes)
        {
            return "<div class='variable' $attributes>".$block[$matches[1]]."</div>";
        },
        $blockhtml)."</div>";
    }
    return $html;
}
?>