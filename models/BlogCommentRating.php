<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog_comment_rating".
 *
 * @property string $id
 * @property string $blog_comment_id
 * @property int $user_id
 * @property string $rating
 *
 * @property BlogComment $blogComment
 * @property User $user
 */
class BlogCommentRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_comment_rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_comment_id', 'user_id'], 'required'],
            [['blog_comment_id', 'user_id'], 'integer'],
            [['rating'], 'number'],
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
            'blog_comment_id' => Yii::t('app', 'Blog Comment ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'rating' => Yii::t('app', 'Rating'),
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
     * @return \app\models\query\BlogCommentRatingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BlogCommentRatingQuery(get_called_class());
    }
}
