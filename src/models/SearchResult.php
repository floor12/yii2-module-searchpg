<?php

namespace floor12\searchpg\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Exception;

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
 */
class SearchResult extends ActiveRecord
{
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'url' => 'Url',
            'indexed' => 'Indexed',
            'updated' => 'Updated',
            'tsvector' => 'Tsvector',
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

    /**
     * @return bool
     * @throws Exception
     */
    public function beforeValidate()
    {
        $this->content = strip_tags($this->content);
        $this->updated = time();
        $this->indexed = time();
        $sql = "SELECT (setweight(to_tsvector('russian', '{$this->title}'),'A') || setweight(to_tsvector('russian', '{$this->content}'), 'B'))";
        $this->tsvector = Yii::$app
            ->db
            ->createCommand($sql)
            ->queryScalar();
        return parent::beforeValidate();
    }
}
