<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\BlogSubscription]].
 *
 * @see \app\models\BlogSubscription
 */
class BlogSubscriptionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\BlogSubscription[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\BlogSubscription|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function countAllSubscriptions()
    {
        return $this->count();
    }
}
