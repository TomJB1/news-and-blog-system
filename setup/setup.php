<?php
# define variables
$domain = $_SERVER['SERVER_NAME'];
global $pdo;
$database = "databases/".$domain.".db";
if(file_exists($database))
{
    $pdo = new  PDO("sqlite:".$database, null, null, [PDO::SQLITE_ATTR_OPEN_FLAGS => PDO::SQLITE_OPEN_READWRITE]);
}
else
{
    # create new database
    $pdo = new  PDO("sqlite:".$database);
    $stmt = $pdo->prepare(
        'CREATE TABLE [pages] (
            [url]	TEXT UNIQUE,
            [blocks]	TEXT,
            [theme]	TEXT,
            [type] TEXT
        );'
    );
    $stmt->execute();
    $stmt = $pdo->prepare('INSERT INTO pages ([url], [blocks], [type]) VALUES ("/home", "[]", "home")');
    $stmt->execute();
    $stmt = $pdo->prepare('INSERT INTO pages ([url], [blocks], [type]) VALUES ("empty", "[]", "template")');
    $stmt->execute();


    $stmt = $pdo->prepare(
        'CREATE TABLE "writers" (
            "id"	INTEGER NOT NULL UNIQUE,
            "username"	TEXT NOT NULL UNIQUE,
            "passwordhash"	TEXT,
            "permissionLevel"	INTEGER,
            PRIMARY KEY("id" AUTOINCREMENT)
        );'
    );
    $stmt->execute();

    $passwordhash = password_hash("NaBs123", PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO writers ([username], [passwordhash], [permissionLevel]) VALUES ("admin", ?, 2)');
    $stmt->execute(array($passwordhash));
    
    echo "newdb";
}

$page = $_SERVER['REQUEST_URI'];
if(preg_match('/(?<interface>(write)|(config))(?<article>.*)/', $page, $matches))
{
    $article = $matches["article"];
    $interface = "writer/".$matches["interface"].'.php';
}
else
{
    $interface = 'page/page.php';
    $article = $page;
}

if($article == "/")
{
    $article = "/home";
}

$stmt = $pdo->prepare("SELECT [blocks], [theme] FROM pages WHERE [url]=?");
$stmt->execute(array($article));
$pageinfo = $stmt->fetch();

function Blocks2Html($blockarray, $editable=false)
{
    $html = "";
    $attributes = "";
    if($editable)
    {
        $attributes = "contenteditable";
        #print_r($blockarray);
    }
    foreach ($blockarray as $id => $block) {
        $filename = "templates/".$block[0].'/template.html';
        $file = fopen($filename, "r");
        $template = fread($file,filesize($filename));
        $html = $html."<div class='block' id='$block[0]'>".preg_replace_callback("/>(.*){([0-9])}/", 
        function($matches) use ($block, $attributes)
        {
            return " class='variable' $attributes>".$matches[1].$block[$matches[2]];
        },
        $template)."</div>";
    }
    $html = preg_replace_callback("/\^(.*?)\*(.*?)\*(.*?)\*/",
    function($matches)
    {
        return "<span class='$matches[1] textstyle'>$matches[2] </span>";
    },
    $html);
    return $html;
}

function GetAllTemplates()
{
    $templates = array_diff(scandir("./templates"), array('.', '..'));
    $templateArray = [];
    foreach ($templates as $id => $name) {
        $filename = "templates/".$name."/template.html";
        $file = fopen($filename, "r");
        $template = preg_replace("/{([0-9])}/", '|var', fread($file,filesize($filename)));
        array_push($templateArray, [$name, $template]);
    }
    return json_encode($templateArray);
}
?>