<?php
include_once __DIR__ . "/../menu.blade.php";
?>
<H1>News categories </H1>
<?php
foreach ($categories as $categoryItem) {
?>
    <a href="<?= route('news.category', $categoryItem['slug']) ?>"><?= $categoryItem['title'] ?></a><br>
<?php
}
