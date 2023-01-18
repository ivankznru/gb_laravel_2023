<?php
include_once __DIR__ . "/../menu.blade.php";
?>
<H1>News from the category <?=$category['title']?> </H1>
<?php
foreach ($news as $newsItem) {
?>
    <a href="<?= route('news.detail', $newsItem['slug']) ?>"><?= $newsItem['title'] ?></a><br>
<?php
}
