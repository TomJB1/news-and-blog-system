<?php
$blockarray = json_decode(GetBlocks($page)[0]);

echo '<div id="page">';
echo Blocks2Html($blockarray);
echo '</div>';

?>