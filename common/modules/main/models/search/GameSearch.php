<?php

namespace bioengine\common\modules\main\models\search;

use bioengine\common\modules\main\models\Game;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * GameSearch represents the model behind the search form about `Game`.
 */
class GameSearch extends Game
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'developer_id', 'status', 'date', 'rate_pos', 'rate_neg'], 'integer'],
            [
                [
                    'id_old',
                    'url',
                    'title',
                    'admin_title',
                    'genre',
                    'release_date',
                    'platforms',
                    'dev',
                    'desc',
                    'keywords',
                    'publisher',
                    'localizator',
                    'logo',
                    'small_logo',
                    'status_old',
                    'tweettag',
                    'news_desc',
                    'info',
                    'specs',
                    'ozon',
                    'voted_users'
                ],
                'safe'
            ],
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
        $query = Game::find();

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
                'id' => $this->id,
                'developer_id' => $this->developer_id,
                'status' => $this->status,
                'date' => $this->date,
                'rate_pos' => $this->rate_pos,
                'rate_neg' => $this->rate_neg,
            ]
        );

        $query->andFilterWhere(['like', 'id_old', $this->id_old])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'admin_title', $this->admin_title])
            ->andFilterWhere(['like', 'genre', $this->genre])
            ->andFilterWhere(['like', 'release_date', $this->release_date])
            ->andFilterWhere(['like', 'platforms', $this->platforms])
            ->andFilterWhere(['like', 'dev', $this->dev])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'publisher', $this->publisher])
            ->andFilterWhere(['like', 'localizator', $this->localizator])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'small_logo', $this->small_logo])
            ->andFilterWhere(['like', 'status_old', $this->status_old])
            ->andFilterWhere(['like', 'tweettag', $this->tweettag])
            ->andFilterWhere(['like', 'news_desc', $this->news_desc])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'specs', $this->specs])
            ->andFilterWhere(['like', 'ozon', $this->ozon])
            ->andFilterWhere(['like', 'voted_users', $this->voted_users]);

        return $dataProvider;
    }
}
