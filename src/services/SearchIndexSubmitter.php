<?php


namespace floor12\searchpg\services;


use floor12\searchpg\enum\Language;
use floor12\searchpg\models\SearchResult;
use Yii;
use yii\base\ErrorException;

class SearchIndexSubmitter
{
    /**
     * @var SearchResult
     */
    protected $model;
    /**
     * @var string
     */
    protected $currentPsqlLanguage;
    /**
     * @var array
     */
    protected $psqlLanguages = [
        Language::ENGLISH => 'english',
        Language::RUSSIAN => 'russian',
    ];


    /**
     * SearchIndexSubmitter constructor.
     * @param string $url
     * @param string $title
     * @param string $content
     * @param string|null $language
     * @param int|null $updated
     * @throws ErrorException
     */
    public function __construct(string $url, string $title, string $content, string $language = null, int $updated = null)
    {
        if (!array_key_exists($language, $this->psqlLanguages))
            throw new ErrorException("Language {$language} cannot be submited in search index.");

        $this->currentPsqlLanguage = $this->psqlLanguages[$language ?: Language::ENGLISH];

        $this->model = SearchResult::findOne(['url' => $url]);

        if (!$this->model)
            $this->model = new SearchResult([
                'url' => $url,
            ]);

        $this->model->title = $title;
        $this->model->content = strip_tags($content);
        $this->model->lang = $language;
        $this->model->updated = $updated ?: time();
        $this->model->indexed = time();
    }

    /**
     * @return bool
     */
    public function submit()
    {
        $this->prepareTsVector();
        return $this->model->save();
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->model->errors;
    }

    /**
     * This method return ts vectored string to store it in a seperate column called `tsvector`
     */
    protected function prepareTsVector()
    {
        $sql = "SELECT (
            setweight(to_tsvector('{$this->currentPsqlLanguage}', '{$this->prepareString($this->model->title)}'),'A') || 
            setweight(to_tsvector('{$this->currentPsqlLanguage}', '{$this->prepareString($this->model->content)}'), 'B')
        )";

        $this->model->tsvector = Yii::$app
            ->db
            ->createCommand($sql)
            ->queryScalar();
    }

    protected function prepareString($string)
    {
        return str_replace("'", "''", $string);
    }

}
