<?php
    if(isset($_POST["newusername"]))
    {
        $passwordhash = password_hash($_POST["newpassword"], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO writers ([username], [passwordhash], [permissionLevel]) VALUES (?, ?, 1)");
        $stmt->execute(array($_POST["newusername"], $passwordhash));

        echo '<script type="text/javascript">
        window.location = "";
        </script>';
    }
    ?>

<h2>Writers</h2>
<?php
$stmt = $pdo->prepare("SELECT [username] FROM writers WHERE [permissionLevel]=1");
$stmt->execute();
$writers = $stmt->fetchAll();
foreach($writers as $id => $writer)
{
    echo $writer["username"];
    echo "<br>";
}
?>

<h2>New writer</h2>
<form  action="" method="POST">
    <label >Username
        <input  name="newusername">
    </label>
    <label >Password
        <input name="newpassword" type="password">
    </lable>
    <input class="login button" type="submit" value="create">
</form>