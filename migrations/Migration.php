<?php

namespace app\migrations;

use yii\db\Migration as BaseMigration;

class Migration extends BaseMigration
{
	
	// https://github.com/yiisoft/yii2/issues/14638#issuecomment-323465218
	public function tinyint($length = null) {
		return $this->getDb()->getSchema()->createColumnSchemaBuilder('tinyint', $length);
	}
}