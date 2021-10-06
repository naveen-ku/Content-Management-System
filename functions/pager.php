<?php
function pagerTiles($count, $page_num)
{
    for ($i = 1; $i <= $count; $i++) {
        if ($i == $page_num) {
            echo "<li><a class='active-link' href='index.php?page={$i}'>{$i}</a></li>";
        } else {
            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }
    }
}
