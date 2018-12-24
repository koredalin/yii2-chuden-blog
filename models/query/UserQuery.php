<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[User]].
 *
 * @see User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Users|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	
    public function getUsernamesLike($str = '')
    {
		$str = trim($str);
		/**
		 * http://stackoverflow.com/a/4345650
		 */
		if (strlen($str) < 2 || !(int) preg_match("/^[a-zA-Z\d]+$/", $str)) {
			return array();
		}
		$userNames = $this->select(['`id`', '`username` AS `text`'])->where(['like', '`username`', $str])->orderBy(['username' => 'SORT_ASC'])->limit(40)->asArray()->all();

		return $userNames;
    }

	public function findUserByUsername($username = '') {
		$username = strval(trim($username));

		return Yii::$app->db->createCommand('SELECT * FROM user WHERE `username` = :username AND `status` = 1')
						->bindValue(':username', $username)
						->queryOne();
	}
}
