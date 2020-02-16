<?php

namespace floor12\searchpg\query;

use floor12\searchpg\models\SearchResult;
use yii\db\ActiveQuery;
use yii\db\Exception;
use yii\db\Expression;

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
        if (empty($question))
            return $this->andWhere('1=0');

        $tsQuery = new Expression("
            plainto_tsquery('russian', '{$question}') as qRu,
            plainto_tsquery('english', '{$question}') as qEn
        ");

        $highlightedTitleExpression = new Expression("CASE
           WHEN lang = 'ru' THEN
               ts_headline('russian', title, qRu)
           ELSE
               ts_headline('english', title, qEn) 
           END as title_highlighted");
        $highlightedContentExression = new Expression("CASE
           WHEN lang = 'ru' THEN
               ts_headline('russian', content, qRu)
           ELSE
               ts_headline('english', content, qEn)
           END as content_highlighted");
        $orderExpression = new Expression("ts_rank(tsvector, qRu || qEn) DESC");
        return $this
            ->select(['*', $highlightedTitleExpression, $highlightedContentExression])
            ->from(['search_index', $tsQuery])
            ->andWhere("tsvector @@ (qRu || qEn)")
            ->orderBy($orderExpression);
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
