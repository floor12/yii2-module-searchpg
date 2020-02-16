<?php
/**
 * @var $this View
 * @var $model SearchResult
 */


use floor12\searchpg\models\SearchResult;
use yii\web\View;

?>

<li>
    <h2><?= $model->title ?></h2>
    <a href="<?= $model->url ?>"><?= $model->url ?></a>
</li>
