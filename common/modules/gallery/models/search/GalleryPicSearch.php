<?php

namespace bioengine\common\modules\gallery\models\search;

use bioengine\common\modules\gallery\models\GalleryPic;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * GalleryPicSearch represents the model behind the search form about `GalleryPic`.
 */
class GalleryPicSearch extends GalleryPic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cat_id', 'game_id', 'developer_id', 'author_id', 'count', 'date', 'pub'], 'integer'],
            [['game_old', 'files', 'desc'], 'safe'],
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
        $query = GalleryPic::find();

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
                'id'           => $this->id,
                'cat_id'       => $this->cat_id,
                'game_id'      => $this->game_id,
                'developer_id' => $this->developer_id,
                'author_id'    => $this->author_id,
                'count'        => $this->count,
                'date'         => $this->date,
                'pub'          => $this->pub,
            ]
        );

        $query->andFilterWhere(['like', 'game_old', $this->game_old])
            ->andFilterWhere(['like', 'files', $this->files])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
