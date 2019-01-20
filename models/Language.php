<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $local_name
 *
 * @property BlogSubscription[] $blogSubscriptions
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'local_name'], 'required'],
            [['code'], 'string', 'max' => 20],
            [['name', 'local_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'local_name' => Yii::t('app', 'Local Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogSubscriptions()
    {
        return $this->hasMany(BlogSubscription::className(), ['language_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\LanguageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\LanguageQuery(get_called_class());
    }
}
