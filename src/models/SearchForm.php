<?php

namespace floor12\searchpg\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\BadRequestHttpException;

class SearchForm extends Model
{
    /**
     * @var string
     */
    public $question;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['question', 'string', 'max' => 100],
            ['question', 'required', 'message' => Yii::t('app.floor12.searchpg', 'Enter words to search.')]
        ];
    }

    /**
     * @return ActiveDataProvider
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function dataProvider()
    {
        if (!$this->validate())
            throw new BadRequestHttpException('Ошибка валидации формы');

        $query = SearchResult::find()->search($this->question);

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}
