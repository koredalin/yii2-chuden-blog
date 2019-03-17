<?php

namespace app\models\query;

use app\models\BlogPost;
use app\models\Language;

/**
 * This is the ActiveQuery class for [[\app\models\BlogPost]].
 *
 * @see \app\models\BlogPost
 */
class BlogPostQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\BlogPost[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\BlogPost|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function getAlternativeLanguages($slug, $language)
    {
        $languageObj = Language::find()->select('id')->where(['code' => $language]);
        return $this->where(['slug' => $slug])
                ->andWhere(['!=', 'language_id', $languageObj])
                ->andWhere(['published' => BlogPost::PUBLISHED])->all();
    }
    
    public function getPreviousPostId($currentPostId)
    {
        $prevPostId = (int)$this->select('id')->where(['<', 'id', (int)$currentPostId])
                ->andWhere(['>', 'id', 0])->max('id');
        
        return $prevPostId;
    }
    
    public function getNextPostId($currentPostId)
    {
        $nextPostId = (int)$this->select('id')->where(['>', 'id', (int)$currentPostId])
                ->andWhere(['>', 'id', 0])->min('id');
        
        return $nextPostId;
    }
}
