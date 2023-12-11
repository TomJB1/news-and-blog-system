<link rel="stylesheet" type="text/css" href="/write.css" />
<?php
echo 'write.php';
echo $article;
$blockarray = json_decode(GetBlocks($article)[0]);

echo '<div id="page">';
echo Blocks2Html($blockarray, true);
echo '</div>';

?>
<div id="writeExtras">
    <input type="button" value="save" onclick="Save()">
    <script defer src="/write.js"></script>
</div>