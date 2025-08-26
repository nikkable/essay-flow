<?php

class m170729_092830_alter_column_on_words_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->alterColumn('{{rc_words}}', 'name', 'decimal(6,2)');
	}

	public function safeDown()
	{
        $this->dropColumn('{{rc_words}}', 'name');
	}
}