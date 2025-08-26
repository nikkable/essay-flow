<?php

class m170731_092830_alter_column_on_words_table extends yupe\components\DbMigration
{
	public function safeUp()
	{
        $this->alterColumn('{{rc_words}}', 'name', 'integer');
	}

	public function safeDown()
	{
        $this->dropColumn('{{rc_words}}', 'name');
	}
}