<h1>write overview coming soon</h1>
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