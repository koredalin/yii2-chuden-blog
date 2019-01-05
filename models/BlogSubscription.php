<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog_subscription".
 *
 * @property string $id
 * @property int $user_id
 * @property string $language
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class BlogSubscription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'language'], 'required'],
            [['user_id'], 'integer'],
            [['language'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['created_at', 'updated_at'], 'safe'],
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
            'language' => Yii::t('app', 'Language'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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
     * @return \app\models\query\BlogSubscriptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BlogSubscriptionQuery(get_called_class());
    }
}
