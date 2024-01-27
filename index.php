<!---
This file is part of news-and-blog-system, a program for creating blog or news sites.
Copyright (C) 2023 Tom Brandis

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License Version 3 as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include 'setup/setup.php';
    ?>
<style>
    <?php
        include 'setup/reset.css';
        include 'themes/'.$pageinfo["theme"];
    ?>
</style>
<?php
include $interface;

?>
</body>
</html>