<?php

class m170728_092830_add_column_on_period_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->addColumn('{{rc_periods}}', 'desc_small', 'string');
	}

	public function safeDown()
	{
        $this->dropColumn('{{rc_periods}}', 'desc_small', 'string');
	}
}