<?php
/**
 * @var $this View
 * @var $model SearchForm
 */

use app\models\search\SearchForm;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\widgets\ListView;

$form = ActiveForm::begin([
    'enableClientValidation' => false,
    'method' => "GET",
    'options' => [
        'class' => 'autosubmit',
        'data-container' => '#pages'
    ]]) ?>

    <h1><?= Yii::t('app', 'Search result') ?></h1>

    <div class="filter-block">
        <?= $form->field($model, 'question')
            ->label(false)
            ->textInput(['placeholder' => 'Поиск...'])
        ?>
    </div>

<?php

ActiveForm::end();

echo ListView::widget([
    'dataProvider' => $model->dataProvider(),
    'itemView' => '_index'
]);
