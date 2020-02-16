<?php

namespace floor12\searchpg;

use Yii;

class Module extends \yii\base\Module
{

    const DEFAULT_INDEX_VIEW = '@vendor/floor12/yii2-module-searchpg/src/views/search/index';
    const DEFAULT_INDEX_ITEM_VIEW = '@vendor/floor12/yii2-module-searchpg/src/views/search/_index';

    /** @inheritdoc */
    public $controllerNamespace = 'floor12\searchpg\controllers';

    /**
     * @var string Layout of main search page
     */
    public $layout;

    /** @var string Path to main index view file for ActionIndex in SearchController */
    public $indexView = self::DEFAULT_INDEX_VIEW;

    /** @var string Path to search result view file for ListViewWidget in ActionIndex in SearchController */
    public $indexItemView = self::DEFAULT_INDEX_ITEM_VIEW;

    /** @inheritDoc */
    public function init()
    {
        $this->registerTranslations();
    }

    /** Registing of translation files */
    public function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations['app.floor12.searchpg'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@vendor/floor12/yii2-module-searchpg/src/messages/',
            'fileMap' => [
                'app.floor12.searchpg' => 'searchpg.php',
            ],
        ];
    }
}
