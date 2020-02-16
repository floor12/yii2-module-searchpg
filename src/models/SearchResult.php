<?php

namespace floor12\searchpg\models;

use floor12\searchpg\query\SearchResultQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "search_index".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $url
 * @property int $indexed
 * @property int $updated
 * @property string $tsvector
 * @property string $lang
 * @property string $title_highlighted
 * @property string $content_highlighted
 */
class SearchResult extends ActiveRecord
{

    public $title_highlighted;

    public $content_highlighted;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'search_index';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'url', 'indexed', 'updated'], 'required'],
            [['content'], 'string'],
            [['indexed', 'updated'], 'default', 'value' => null],
            [['indexed', 'updated'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 2],
        ];
    }
    

    /**
     * {@inheritdoc}
     * @return SearchResultQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SearchResultQuery(get_called_class());
    }


}
