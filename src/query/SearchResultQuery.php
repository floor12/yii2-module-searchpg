<?php

namespace floor12\searchpg\query;

use floor12\searchpg\models\SearchResult;
use Yii;
use yii\db\ActiveQuery;
use yii\db\Exception;

/**
 * @see SearchResult
 */
class SearchResultQuery extends ActiveQuery
{
    /**
     * @param string $question
     * @return SearchResultQuery
     * @throws Exception
     */
    public function search(string $question)
    {
        $tsVectoredQuestion = $this->prepareTsVectoredQuestion($question);
        if (empty($tsVectoredQuestion))
            return $this->andWhere('1=0');

        return $this->andWhere("tsvector @@ plainto_tsquery('{$tsVectoredQuestion}')");
    }

    /**
     * @param string $question
     * @return bool|string
     * @throws Exception
     */
    protected function prepareTsVectoredQuestion(string $question)
    {
        $tsVectoredQuestion = Yii::$app->db
            ->createCommand("SELECT to_tsvector('russian','{$question}')")
            ->queryScalar();

        if (!preg_match_all("/'([^ ]+)'/", $tsVectoredQuestion, $matches))
            return false;

        return implode(' ', $matches[1]);
    }

    /**
     * {@inheritdoc}
     * @return SearchResult[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SearchResult|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
