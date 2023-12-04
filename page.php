<?php

echo 'page.php';
echo '<br>';
echo $page;


$blockarray = [["title", "hi"]];#GetBlocks($page);

foreach ($blockarray as $id => $block) {
    $filename = "templates/".$block[0].'.template';
    $file = fopen($filename, "r");
    $blockhtml = fread($file,filesize($filename));
    echo preg_replace_callback("/{([0-9])}/", 
    function($matches) use ($block)
    {
        return $block[$matches[1]];
    },
    $blockhtml);
}

?>