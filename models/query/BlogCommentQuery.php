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
    
    public function getParentPostComments($blog_post_id)
    {
        return $this->where(['blog_post_id' => (int)$blog_post_id, 'parent_id' => null])
                ->orderBy(['created_at' => SORT_DESC])->all();
    }
    
    public function getHeirPostComments($blog_post_id)
    {
        return $this->where(['blog_post_id' => (int)$blog_post_id])
//                ->andWhere('`parent_id` IS NOT NULL')
                ->andWhere(['IS NOT', 'parent_id', null])
                ->orderBy(['created_at' => SORT_ASC])->all();
    }
}
