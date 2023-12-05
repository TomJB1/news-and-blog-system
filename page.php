<?php

echo 'page.php';
echo '<br>';
echo $page;


$blockarray = [["title", "h"], ["title", "2"]];#GetBlocks($page);

echo Blocks2Html($blockarray);

?>