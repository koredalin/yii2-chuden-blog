<?php

namespace app\models;

use Yii;
use dektrium\user\models\User as BaseUser;
use app\models\query\UserQuery;

/**
 * User ActiveRecord model.
 *
 * @author Hristo Hristov <koredalin@yahoo.com>
 */
class User extends BaseUser
{

	/**
	 * @inheritdoc
	 * @return UserQuery the active query used by this AR class.
	 */
	public static function find() {
		return new UserQuery(get_called_class());
	}
}
