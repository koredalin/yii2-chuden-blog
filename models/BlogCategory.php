<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog_category".
 *
 * @property string $id
 * @property string $name
 * @property string $parent_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BlogCategory $parent
 * @property BlogCategory[] $blogCategories
 * @property BlogPost[] $blogPosts
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCategories()
    {
        return $this->hasMany(BlogCategory::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPosts()
    {
        return $this->hasMany(BlogPost::className(), ['blog_category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BlogCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BlogCategoryQuery(get_called_class());
    }
}
