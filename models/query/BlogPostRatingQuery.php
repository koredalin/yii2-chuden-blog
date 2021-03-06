<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\BlogPostRating]].
 *
 * @see \app\models\BlogPostRating
 */
class BlogPostRatingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\BlogPostRating[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\BlogPostRating|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function getPostRating($blog_post_id)
    {
        return round($this->where(['blog_post_id' => (int)$blog_post_id])->average('rating'), 2);
    }
    
    public function getPostVoteCount($blog_post_id)
    {
        return (int)$this->where(['blog_post_id' => (int)$blog_post_id])->count();
    }
}
