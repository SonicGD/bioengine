<?php

namespace bioengine\common\modules\files\models\search;

use bioengine\common\modules\files\models\File;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FileSearch represents the model behind the search form about `File`.
 */
class FileSearch extends File
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cat_id', 'game_id', 'developer_id', 'size', 'stream', 'yt_status', 'author_id', 'count', 'date'], 'integer'],
            [['url', 'game_old', 'title', 'desc', 'announce', 'file', 'link', 'streamfile', 'yt_title', 'yt_url'], 'safe'],
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
        $query = File::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cat_id' => $this->cat_id,
            'game_id' => $this->game_id,
            'developer_id' => $this->developer_id,
            'size' => $this->size,
            'stream' => $this->stream,
            'yt_status' => $this->yt_status,
            'author_id' => $this->author_id,
            'count' => $this->count,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'game_old', $this->game_old])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'announce', $this->announce])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'streamfile', $this->streamfile])
            ->andFilterWhere(['like', 'yt_title', $this->yt_title])
            ->andFilterWhere(['like', 'yt_url', $this->yt_url]);

        return $dataProvider;
    }
}
