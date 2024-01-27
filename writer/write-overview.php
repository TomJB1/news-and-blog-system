<h1>write overview</h1>
<?php
if($_POST)
{

    if(isset($_POST["newpageurl"]))
    {
        $stmt = $pdo->prepare("INSERT INTO pages ([url], [blocks]) VALUES (?, '[]')");
        $stmt->execute(array("/".$_POST["newpageurl"]));
    }

    if(isset($_POST["pageurl"]) && isset($_POST["newtheme"]))
    {
        $stmt = $pdo->prepare("UPDATE pages SET [theme]=? WHERE [url]=?");
        $stmt->execute(array($_POST["newtheme"], $_POST["pageurl"]));
        echo "updated ".$_POST["pageurl"]." to new theme ".$_POST["newtheme"];
    }
    echo '<script type="text/javascript">
        window.location = "";
        </script>';

} 


?>
<h2>New page</h2>
<form  action="" method="POST">
    <label >Page url
        <input  name="newpageurl">
    </label>
    <input class="login button" type="submit" value="create">
</form>
<h2>Pages</h2>
<?php 
    $stmt = $pdo->prepare("SELECT [url], [theme] FROM pages");
    $stmt->execute();
    $pages = $stmt->fetchAll();
    echo "<table border='1px'>";
    $themes = array_diff(scandir("./themes"), array('.', '..'));
    $theme_options = "";
    foreach($themes as $i => $theme)
    {
        $theme_options .= "<option value=$theme>$theme</option>";
    }
    foreach($pages as $id => $page)
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
?>