<?php

class m151211_115450_add_katarun_fields extends yupe\components\DbMigration
{
	public function safeUp()
	{
		// id заказа
		$this->addColumn('{{store_order}}', 'katarun_id', 'VARCHAR(150)');
	}
}