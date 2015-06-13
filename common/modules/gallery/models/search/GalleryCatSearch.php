<?php

namespace bioengine\common\modules\gallery\models\search;

use bioengine\common\modules\gallery\models\GalleryCat;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * GalleryCatSearch represents the model behind the search form about `GalleryCat`.
 */
class GalleryCatSearch extends GalleryCat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['pid', 'game_id', 'developer_id'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 100],
            [['game_old'], 'string', 'max' => 40]

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
        $query = GalleryCat::find();
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
                'pid'          => $this->pid,
                'game_id'      => $this->game_id,
                'developer_id' => $this->developer_id
            ]
        );

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'game_old', $this->game_old])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
