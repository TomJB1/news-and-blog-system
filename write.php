<?php
echo 'write.php';
echo $article;
$blockarray = json_decode(GetBlocks($article)[0]);
var_dump($blockarray);

echo '<div id="page">';
echo Blocks2Html($blockarray, true);
echo '</div>';

?>
<script defer src="/write.js"></script>