<?php

namespace bioengine\common\modules\articles\models\search;

use bioengine\common\modules\articles\models\Article;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ArticleSearch represents the model behind the search form about `Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['id', 'cat_id', 'game_id', 'developer_id', 'topic_id', 'author_id', 'count', 'date', 'pub', 'fs'],
                'integer'
            ],
            [['url', 'source', 'game_old', 'title', 'announce', 'text'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Article::find();
        $query->orderBy(['id' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query
            ]
        );

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(
            [
                'id'           => $this->id,
                'cat_id'       => $this->cat_id,
                'game_id'      => $this->game_id,
                'developer_id' => $this->developer_id,
                'topic_id'     => $this->topic_id,
                'author_id'    => $this->author_id,
                'count'        => $this->count,
                'date'         => $this->date,
                'pub'          => $this->pub,
                'fs'           => $this->fs
            ]
        );

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'game_old', $this->game_old])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'announce', $this->announce])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
