<link rel="stylesheet" type="text/css" href="/write-frontend/write.css" />
<div id="page">
    <div class="headerblock">
        <div class="writeheader">
        <?php
        echo 'write.php';
        echo $article;
        $blockarray = json_decode(GetBlocks($article)[0]);
        ?>
        </div>
    </div>
<?php
echo Blocks2Html($blockarray, true);
?>
</div>

<div id="writeExtras">
    <input type="button" value="save" onclick="Save()">
    <input type="button" value="remove" onclick="deleteSelected()">
    <script defer src="/write-frontend/write.js"></script>
</div>