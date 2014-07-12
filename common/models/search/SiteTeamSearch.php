<?php

namespace bioengine\common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use bioengine\common\models\SiteTeam;

/**
 * SiteTeamSearch represents the model behind the search form about `bioengine\common\models\SiteTeam`.
 */
class SiteTeamSearch extends SiteTeam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'member_id', 'developers', 'games', 'news', 'articles', 'files', 'gallery', 'polls', 'tags', 'active'], 'integer'],
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
        $query = SiteTeam::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'member_id' => $this->member_id,
            'developers' => $this->developers,
            'games' => $this->games,
            'news' => $this->news,
            'articles' => $this->articles,
            'files' => $this->files,
            'gallery' => $this->gallery,
            'polls' => $this->polls,
            'tags' => $this->tags,
            'active' => $this->active,
        ]);

        return $dataProvider;
    }
}
