<?php

namespace floor12\searchpg\query;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[SearchResult]].
 *
 * @see SearchResult
 */
class SearchResultQuery extends ActiveQuery
{
    /**
     * @param string $question
     * @return SearchResultQuery
     * @throws \yii\db\Exception
     */
    public function search(string $question)
    {
        $tsVectoredQuestion = Yii::$app->db
            ->createCommand("SELECT to_tsvector('russian','{$question}')")
            ->queryScalar();
        if (preg_match_all("/'([^ ]+)'/", $tsVectoredQuestion, $matches)) {
            $question = implode(' ', $matches[1]);
            return $this->andWhere("tsvector @@ plainto_tsquery('{$question}')");
        }
        return $this->andWhere('1=0');
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
