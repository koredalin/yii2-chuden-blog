<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog_comment_like".
 *
 * @property string $id
 * @property int $user_id
 * @property string $blog_comment_id
 *
 * @property BlogComment $blogComment
 * @property User $user
 */
class BlogCommentLike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_comment_like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'blog_comment_id'], 'required'],
            [['user_id', 'blog_comment_id'], 'integer'],
            [['user_id', 'blog_comment_id'], 'unique', 'targetAttribute' => ['user_id', 'blog_comment_id']],
            [['blog_comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogComment::className(), 'targetAttribute' => ['blog_comment_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'blog_comment_id' => Yii::t('app', 'Blog Comment ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComment()
    {
        return $this->hasOne(BlogComment::className(), ['id' => 'blog_comment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BlogCommentLikeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BlogCommentLikeQuery(get_called_class());
    }
}
