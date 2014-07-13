<?php

namespace bioengine\common\modules\polls\models\search;

use bioengine\common\modules\polls\models\Poll;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PollSearch represents the model behind the search form about `Poll`.
 */
class PollSearch extends Poll
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poll_id', 'startdate', 'num_choices', 'multiple', 'onoff'], 'integer'],
            [['question', 'options', 'votes'], 'safe'],
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
        $query = Poll::find();

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
                'poll_id'     => $this->poll_id,
                'startdate'   => $this->startdate,
                'num_choices' => $this->num_choices,
                'multiple'    => $this->multiple,
                'onoff'       => $this->onoff,
            ]
        );

        $query->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'options', $this->options])
            ->andFilterWhere(['like', 'votes', $this->votes]);

        return $dataProvider;
    }
}
