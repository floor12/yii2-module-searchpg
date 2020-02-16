<?php


namespace floor12\searchpg\controllers;


use app\models\search\SearchForm;
use Yii;
use yii\web\Controller;

class SearchController extends Controller
{
    public function actionIndex()
    {
        $model = new SearchForm();
        $model->load(Yii::$app->request->get());
        return $this->render('index', [
            'model' => $model
        ]);
    }
}
