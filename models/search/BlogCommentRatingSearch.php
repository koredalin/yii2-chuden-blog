<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BlogCommentRating;

/**
 * BlogCommentRatingSearch represents the model behind the search form of `app\models\BlogCommentRating`.
 */
class BlogCommentRatingSearch extends BlogCommentRating
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'blog_comment_id', 'user_id'], 'integer'],
            [['rating'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = BlogCommentRating::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'blog_comment_id' => $this->blog_comment_id,
            'user_id' => $this->user_id,
            'rating' => $this->rating,
        ]);

        return $dataProvider;
    }
}
