<?php

namespace floor12\searchpg;

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

}
