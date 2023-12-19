<?php
/*
CREATE TABLE "writers" (
	"id"	INTEGER NOT NULL UNIQUE,
	"username"	TEXT,
	"passwordhash"	TEXT,
	"permissionLevel"	INTEGER,
	PRIMARY KEY("id" AUTOINCREMENT)
);
*/
if(isset($_POST["username"]))
{
    $stmt = $pdo->prepare("SELECT [passwordhash] FROM writers WHERE [username]=?");
    $stmt->execute(array($_POST["username"]));
    $passwordhash = $stmt->fetch()[0];

    if(isset($passwordhash) && password_verify($_POST["password"], $passwordhash))
    {
        $stmt = $pdo->prepare("SELECT [username], [permissionLevel] FROM writers WHERE [username]=?");
        $stmt->execute(array($_POST["username"]));
        $_SESSION = $stmt->fetch();
    }
}
else if(isset($_POST["newusername"]))
{
    $passwordhash = password_hash($_POST["newpassword"], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO writers ([username], [passwordhash], [permissionLevel]) VALUES (?, ?, 1)");
    $stmt->execute(array($_POST["newusername"], $passwordhash));
    $passwordhash = $stmt->fetch();
}
echo '<script type="text/javascript">
        window.location = "";
        </script>';
?>

<h2>Login</h2>
<form  action="" method="POST">
    <label >Username
        <input  name="username">
    </label>
    <label >Password
        <input name="password" type="password">
    </lable>
    <input class="login button" type="submit" value="login">
</form>

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