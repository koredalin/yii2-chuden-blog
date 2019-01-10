<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog_post_rating".
 *
 * @property string $id
 * @property string $blog_post_id
 * @property int $user_id
 * @property string $rating
 *
 * @property BlogPost $blogPost
 * @property User $user
 */
class BlogPostRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_post_rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_post_id', 'user_id', 'rating'], 'required'],
            [['blog_post_id', 'user_id'], 'integer'],
            [['rating'], 'number'],
            [['blog_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogPost::className(), 'targetAttribute' => ['blog_post_id' => 'id']],
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
            'blog_post_id' => Yii::t('app', 'Blog Post ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'rating' => Yii::t('app', 'Rating'),
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BlogPostRatingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BlogPostRatingQuery(get_called_class());
    }
    
    public static function getHtmlRatingStars($rating, $idPrefix = '')
    {
        $rating = round($rating, 2);
        $rating > 5 ? $rating = 5 : false;
        $rating <= 0 ? $rating = 0 : false;
        $ratingPercentage = round($rating / 5 * 100, 1);
        $idPrefix = strtolower(trim($idPrefix));
        strlen($idPrefix) > 0 ? $idPrefix .= '_' : false;
        // https://codepen.io/filcp/pen/QvZVOg
        $htmlStars = 
            '<div class="star-rating" title="100%">
                <div class="back-stars">
                    <i id="'.$idPrefix.'back_star1" class="fa fa-star" aria-hidden="true"></i>
                    <i id="'.$idPrefix.'back_star2" class="fa fa-star" aria-hidden="true"></i>
                    <i id="'.$idPrefix.'back_star3" class="fa fa-star" aria-hidden="true"></i>
                    <i id="'.$idPrefix.'back_star4" class="fa fa-star" aria-hidden="true"></i>
                    <i id="'.$idPrefix.'back_star5" class="fa fa-star" aria-hidden="true"></i>

                    <div class="front-stars" style="width: '.$ratingPercentage.'%">
                        <i id="'.$idPrefix.'front_star1" class="fa fa-star" aria-hidden="true"></i>
                        <i id="'.$idPrefix.'front_star2" class="fa fa-star" aria-hidden="true"></i>
                        <i id="'.$idPrefix.'front_star3" class="fa fa-star" aria-hidden="true"></i>
                        <i id="'.$idPrefix.'front_star4" class="fa fa-star" aria-hidden="true"></i>
                        <i id="'.$idPrefix.'front_star5" class="fa fa-star" aria-hidden="true"></i>
                    </div>
                </div>
            </div>';
        return $htmlStars;
    }
}
