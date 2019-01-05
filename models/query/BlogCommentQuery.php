<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\BlogComment]].
 *
 * @see \app\models\BlogComment
 */
class BlogCommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\BlogComment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\BlogComment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function getAllPostComments($blog_post_id)
    {
        return $this->where(['blog_post_id' => (int)$blog_post_id])
                ->orderBy(['updated_at' => SORT_DESC])->all();
    }
}
