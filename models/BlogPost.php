<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog_post".
 *
 * @property string $id
 * @property int $published
 * @property string $language
 * @property string $slug
 * @property string $title
 * @property string $meta_description
 * @property string $blog_category_id
 * @property string $tags
 * @property string $content
 * @property string $rating
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BlogComment[] $blogComments
 * @property BlogCategory $blogCategory
 * @property BlogPostRating[] $blogPostRatings
 */
class BlogPost extends \yii\db\ActiveRecord
{
    const NOT_PUBLISHED = 0;
    const PUBLISHED = 1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['published', 'blog_category_id'], 'integer'],
            [['language', 'slug', 'title', 'meta_description', 'blog_category_id', 'content'], 'required'],
            [['language', 'content'], 'string'],
            [['rating'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['slug'], 'string', 'max' => 120],
            [['title'], 'string', 'max' => 100],
            [['meta_description'], 'string', 'max' => 230],
            [['tags'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['meta_description'], 'unique'],
            [['slug'], 'unique'],
            [['blog_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['blog_category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'published' => Yii::t('app', 'Published'),
            'language' => Yii::t('app', 'Language'),
            'slug' => Yii::t('app', 'Slug'),
            'title' => Yii::t('app', 'Title'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'blog_category_id' => Yii::t('app', 'Blog Category ID'),
            'tags' => Yii::t('app', 'Tags'),
            'content' => Yii::t('app', 'Content'),
            'rating' => Yii::t('app', 'Rating'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComments()
    {
        return $this->hasMany(BlogComment::className(), ['blog_post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCategory()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'blog_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPostRatings()
    {
        return $this->hasMany(BlogPostRating::className(), ['blog_post_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BlogPostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BlogPostQuery(get_called_class());
    }
}
