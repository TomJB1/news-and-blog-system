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
    <h1>write overview</h1>
<?php endif?>