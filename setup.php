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
        print_r($blockarray);
    }
    foreach ($blockarray as $id => $block) {
        $filename = "templates/".$block[0].'.template';
        $file = fopen($filename, "r");
        $template = fread($file,filesize($filename));
        $html = $html."<div class='block' id='$block[0]'>".preg_replace_callback("/{([0-9])}/", 
        function($matches) use ($block, $attributes)
        {
            return "<div class='variable' $attributes>".$block[$matches[1]]."</div>";
        },
        $template)."</div>";
    }
    return $html;
}

function GetAllTemplates()
{
    $templates = array_diff(scandir("./templates"), array('.', '..'));
    $templateArray = [];
    foreach ($templates as $id => $name) {
        $blockname = explode('.', $name)[0];
        $filename = "templates/".$name;
        $file = fopen($filename, "r");
        $template = preg_replace("/{([0-9])}/", '|var', fread($file,filesize($filename)));
        array_push($templateArray, [$blockname, $template]);
    }
    return json_encode($templateArray);
}
?>