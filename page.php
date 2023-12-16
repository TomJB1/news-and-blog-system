<?php
$blockarray = json_decode($pageinfo["blocks"]);

echo '<div id="page">';
echo Blocks2Html($blockarray);
echo '</div>';

?>