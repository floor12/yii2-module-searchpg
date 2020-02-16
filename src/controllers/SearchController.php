<?php


namespace floor12\searchpg\controllers;


use floor12\searchpg\models\SearchForm;
use floor12\searchpg\Module;
use Yii;
use yii\web\Controller;

class SearchController extends Controller
{
    /**
     * @var Module
     */
    protected $searchModule;
    /**
     * @var string
     */
    protected $indexView;

    /** @inheritDoc */
    public function init()
    {
        $this->searchModule = $this->getModules()[0]->getModule('searchpg');
        $this->layout = $this->searchModule->layout;
        $this->indexView = $this->searchModule->indexView;
    }

    /**
     * Search result page
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->getView()->title = Yii::t('app.floor12.searchpg', 'Site search');
        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => Yii::t('app.floor12.searchpg', 'This is a site search page.')
        ]);

        $model = new SearchForm();
        $model->load(Yii::$app->request->get());

        return $this->render($this->indexView, [
            'model' => $model
        ]);
    }
}
