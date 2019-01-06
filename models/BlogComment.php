<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog_comment".
 *
 * @property string $id
 * @property string $content
 * @property int $user_id
 * @property string $blog_post_id
 * @property string $parent_id
 * @property string $rating
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BlogPost $blogPost
 * @property BlogComment $parent
 * @property BlogComment[] $blogComments
 * @property User $user
 * @property BlogCommentRating[] $blogCommentRatings
 */
class BlogComment extends \yii\db\ActiveRecord
{
    public $verifyCode;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = [
            [['content', 'user_id', 'blog_post_id'], 'required'],
            [['content'], 'string'],
            [['user_id', 'blog_post_id', 'parent_id'], 'integer'],
            [['rating'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['blog_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogPost::className(), 'targetAttribute' => ['blog_post_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogComment::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
        $ctrlAct = Yii::$app->controller->id . '-' . Yii::$app->controller->action->id;
        if (in_array($ctrlAct, array('blog/comment-create', 'blog/comment-update'), true)) {
            $rules[] = ['verifyCode', 'captcha'];
        }
        
        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'content' => Yii::t('app', 'Content'),
            'user_id' => Yii::t('app', 'User ID'),
            'blog_post_id' => Yii::t('app', 'Blog Post ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'rating' => Yii::t('app', 'Rating'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPost()
    {
        return $this->hasOne(BlogPost::className(), ['id' => 'blog_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(BlogComment::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComments()
    {
        return $this->hasMany(BlogComment::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCommentRatings()
    {
        return $this->hasMany(BlogCommentRating::className(), ['blog_comment_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BlogCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BlogCommentQuery(get_called_class());
    }
}
