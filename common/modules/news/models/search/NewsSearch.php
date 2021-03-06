<?php

namespace bioengine\common\modules\news\models\search;

use bioengine\common\modules\news\models\News;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * NewsSearch represents the model behind the search form about `News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'game_id',
                    'developer_id',
                    'topic_id',
                    'author_id',
                    'tid',
                    'pid',
                    'sticky',
                    'date',
                    'last_change_date',
                    'pub',
                    'rate_pos',
                    'rate_neg',
                    'comments',
                    'twitter_id'
                ],
                'integer'
            ],
            [['url', 'source', 'game_old', 'title', 'short_text', 'add_text', 'addgames', 'voted_users'], 'safe'],
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
        $query = News::find();
        $query->orderBy(['id' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(
            [
                'id'               => $this->id,
                'game_id'          => $this->game_id,
                'developer_id'     => $this->developer_id,
                'topic_id'         => $this->topic_id,
                'author_id'        => $this->author_id,
                'tid'              => $this->tid,
                'pid'              => $this->pid,
                'sticky'           => $this->sticky,
                'date'             => $this->date,
                'last_change_date' => $this->last_change_date,
                'pub'              => $this->pub,
                'rate_pos'         => $this->rate_pos,
                'rate_neg'         => $this->rate_neg,
                'comments'         => $this->comments,
                'twitter_id'       => $this->twitter_id,
            ]
        );

        $query
            ->orFilterWhere(['like', 'title', $this->title])
            ->orFilterWhere(['like', 'short_text', $this->short_text])
            ->orFilterWhere(['like', 'add_text', $this->add_text]);

        return $dataProvider;
    }
}
