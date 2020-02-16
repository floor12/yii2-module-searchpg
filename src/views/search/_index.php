<?php
/**
 * @var $this View
 * @var $model SearchResult
 */

use app\models\search\SearchResult;
use yii\web\View;

?>

<li>
    <h2><?= $model->title ?></h2>
    <a href="<?= $model->url ?>"><?= $model->url ?></a>
</li>
