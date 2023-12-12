<link rel="stylesheet" type="text/css" href="/write.css" />
<div class="headerblock">
    <div class="writeheader">

    <?php
    echo 'write.php';
    echo $article;
    $blockarray = json_decode(GetBlocks($article)[0]);
    ?>

    </div>
</div>

<div id="page">
<?php
echo Blocks2Html($blockarray, true);
?>
</div>

<div id="writeExtras">
    <input type="button" value="save" onclick="Save()">
    <input type="button" value="remove" onclick="deleteSelected()">
    <script defer src="/write.js"></script>
</div>