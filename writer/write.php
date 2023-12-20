<?php
session_start();
if(isset($_SESSION["permissionLevel"]) && $_SESSION["permissionLevel"] >= 1):  //IF logged in?>
    <?php if($pageinfo):?>
    <link rel="stylesheet" type="text/css" href="/write-frontend/write.css" />
    <div id="page">
        <div class="headerblock">
            <div class="writeheader">
            <?php
            echo 'write.php';
            echo $article;
            $blockarray = json_decode($pageinfo["blocks"]);
            ?>
            </div>
        </div>
    <?php
    echo Blocks2Html($blockarray, true);
    ?>
    </div>
    <div id="styleModifiers">
        <input type="button" value="n" class="styleModifier" onclick="addTextStyle('normal')">
        <input type="button" value="B" class="styleModifier" onclick="addTextStyle('bold')">
        <input type="button" value="I" class="styleModifier" onclick="addTextStyle('italic')">
    </div>
    <div id="writeExtras">
        <input type="button" value="save" onclick="Save()">
        <input type="button" value="remove" onclick="deleteSelected()">
        <script defer src="/write-frontend/write.js"></script>
    </div>
<?php else:?>
<?php 
if($_SESSION["permissionLevel"] >= 2)
{
    include 'admin.php';
}
else if($_SESSION["permissionLevel"] >= 1)
{
    include 'write-overview.php';
}
    
?>
<?php endif?>
<?php else: // log in?>
    <?php include 'writer/login.php'?>
<?php endif?>