<?php

namespace bioengine\common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use bioengine\common\models\Developer;

/**
 * DeveloperSearch represents the model behind the search form about `bioengine\common\models\Developer`.
 */
class DeveloperSearch extends Developer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'found_year', 'rate_pos', 'rate_neg'], 'integer'],
            [['url', 'name', 'info', 'desc', 'logo', 'location', 'peoples', 'site', 'voted_users'], 'safe'],
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
        $query = Developer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'found_year' => $this->found_year,
            'rate_pos' => $this->rate_pos,
            'rate_neg' => $this->rate_neg,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'peoples', $this->peoples])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'voted_users', $this->voted_users]);

        return $dataProvider;
    }
}
