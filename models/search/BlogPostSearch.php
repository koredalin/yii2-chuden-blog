<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BlogPost;

/**
 * BlogPostSearch represents the model behind the search form of `app\models\BlogPost`.
 */
class BlogPostSearch extends BlogPost
{
    public $languageCode = '';
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'published', 'language_id', 'blog_category_id'], 'integer'],
            [['slug', 'title', 'meta_description', 'tags', 'content', 'created_at', 'updated_at', 'languageCode'], 'safe'],
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
        $query = BlogPost::find();

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

        $publishedFilter = (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin) ? $this->published : 1;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'published' => $publishedFilter,
            'blog_category_id' => $this->blog_category_id,
            'rating' => $this->rating,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $lang = strlen(trim($this->languageCode)) > 0
                ? \app\models\Language::find()->select('id')->where(['like', 'code', $this->languageCode])->orWhere(['like', 'name', $this->languageCode])
                : $this->language_id;
        $query->andFilterWhere(['IN', 'language_id', $lang])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
