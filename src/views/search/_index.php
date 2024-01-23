<?php
/**
 * @var $this View
 * @var $model SearchResult
 */


use floor12\searchpg\models\SearchResult;
use yii\web\View;

?>

<li>
    <h4>
        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl($model->url) ?>">
            <?= $model->title_highlighted ?>
        </a>
    </h4>
    <p><?= $model->content_highlighted ?></p>
    <time><?= Yii::$app->formatter->asDatetime($model->updated) ?></time>
    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl($model->url) ?>">
        <?= Yii::$app->urlManager->createAbsoluteUrl($model->url) ?>
    </a>
</li>
