<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\BlogCommentLike]].
 *
 * @see \app\models\BlogCommentLike
 */
class BlogCommentLikeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\BlogCommentLike[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\BlogCommentLike|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function getUserCommentLikeIdsPerPost($user_id, $blog_post_id)
    {
		$sqlStr = 'SELECT bcl.blog_comment_id
                FROM blog_comment_like AS bcl
                WHERE bcl.user_id = :user_id
                    AND bcl.blog_comment_id IN (
                        SELECT bc.id FROM blog_comment AS bc WHERE bc.blog_post_id = :blog_post_id
                    );';
		return \Yii::$app->db->createCommand($sqlStr)
						->bindValue(':user_id', (int)$user_id)
						->bindValue(':blog_post_id', (int)$blog_post_id)
						->queryAll();
    }
}
