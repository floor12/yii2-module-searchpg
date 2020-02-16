<?php
/**
 * @var $this View
 * @var $model SearchForm
 */

use floor12\searchpg\models\SearchForm;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

$form = ActiveForm::begin([
    'enableClientValidation' => false,
    'method' => "GET",
]) ?>

    <h1><?= Yii::t('app.floor12.searchpg', 'Search result') ?></h1>

    <div class="filter-block">
        <?= $form
            ->field($model, 'question')
            ->label(false)
            ->textInput(['placeholder' => 'Поиск...']) ?>
    </div>

<?php

ActiveForm::end();

echo ListView::widget([
    'dataProvider' => $model->dataProvider(),
    'itemView' => $this->context
]);
