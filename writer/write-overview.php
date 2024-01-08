<h1>write overview</h1>
<?php
if(isset($_POST["newpageurl"]))
{
    $stmt = $pdo->prepare("INSERT INTO pages ([url], [blocks]) VALUES (?, '[]')");
    $stmt->execute(array("/".$_POST["newpageurl"]));
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
    $stmt = $pdo->prepare("SELECT [url] FROM pages");
    $stmt->execute();
    $pages = $stmt->fetchAll();
    echo "<table border='1px'>";
    foreach($pages as $id => $page)
    {
        $pageurl = $page['url'];
        echo <<<ROW
        <tr>
        <td><a href='$pageurl'>$pageurl</a></td>
        <td><a href='/write$pageurl'>edit</a></td>
        </tr>
        ROW;
    }
    echo '</table>';
?>