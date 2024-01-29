<h1>write overview</h1>
<?php
if($_POST)
{
    if(isset($_POST["template"])&&isset($_POST["newpageurl"]))
    {
        // new page
        $stmt = $pdo->prepare("SELECT [blocks], [theme] FROM pages WHERE [url]=? AND [type]='template'");
        $stmt->execute(array($_POST["template"]));
        $template = $stmt->fetch();

        $stmt = $pdo->prepare("INSERT INTO pages ([url], [blocks], [theme], [type]) VALUES (?, ?, ?, 'page')");
        $stmt->execute(array("/".$_POST["newpageurl"], $template["blocks"], $template["theme"]));
        echo "new page";
    }
    else if(isset($_POST["newtemplate"]))
    {
        // new template
        $stmt = $pdo->prepare("INSERT INTO pages ([url], [blocks], [type]) VALUES (?, '[]', 'template')");
        $stmt->execute(array("/".$_POST["newtemplate"]));
    }
    else if(isset($_POST["pageurl"]) && isset($_POST["newtheme"]))
    {
        // change theme
        $stmt = $pdo->prepare("UPDATE pages SET [theme]=? WHERE [url]=?");
        $stmt->execute(array($_POST["newtheme"], $_POST["pageurl"]));
        echo "updated ".$_POST["pageurl"]." to new theme ".$_POST["newtheme"];
    }
    echo '<script type="text/javascript">
        window.location = "";
        </script>';

} 

$stmt = $pdo->prepare('SELECT [url], [theme] FROM pages WHERE [type]="template"');
$stmt->execute();
$templates = $stmt->fetchAll();
$template_options = "";
foreach($templates as $i => $template)
{
    $url = $template["url"];
    $template_options .= "<option value=$url>$url</option>";
}

echo <<<SECTION
<h2>New page</h2>
<form  action="" method="POST">
    <label >Page url
        <input  name="newpageurl">
    </label>
    <select name="template">
        $template_options
    </select>
    <input class="login button" type="submit" value="create">
</form>
<h2>Pages</h2>
SECTION;

function pageGrid($rows, $themes) 
{
    echo "<table border='1px'>";
    $theme_options = "";
    foreach($themes as $i => $theme)
    {
        $theme_options .= "<option value=$theme>$theme</option>";
    }
    foreach($rows as $id => $page)
    {
        $theme_options_selected = $theme_options."<option selected value=".$page["theme"].">theme: ".$page["theme"]."</option>";
        $pageurl = $page['url'];

        echo <<<ROW
        <tr>
        <td><a href='$pageurl'>$pageurl</a></td>
        <td><a href='/write$pageurl'>edit</a></td>
        <td>
            <form  action="" method="POST">
                <input type="hidden" name="pageurl" value="$pageurl"></input>
                <select name="newtheme" onchange="javascript:this.form.submit()" >
                    $theme_options_selected
                </select>
            </form>
        </td>
        </tr>
        ROW;
    }
    echo '</table>';
}

    $stmt = $pdo->prepare('SELECT [url], [theme] FROM pages WHERE [type]<>"template"');
    $stmt->execute();
    $pages = $stmt->fetchAll();
    echo "<table border='1px'>";
    $themes = array_diff(scandir("./themes"), array('.', '..'));
    pageGrid($pages, $themes)
?>
<h2>New template</h2>
<form  action="" method="POST">
    <label >template name
        <input  name="newtemplate">
    </label>
    <input class="login button" type="submit" value="create">
</form>
<h2> Templates </h2>
<?php
pageGrid($templates, $themes)
?>