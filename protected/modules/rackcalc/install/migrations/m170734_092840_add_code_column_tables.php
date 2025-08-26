<?php
class m170734_092840_add_code_column_tables extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{rc_periods}}', 'code', 'varchar(100) NOT NULL');
        $this->addColumn('{{rc_subjects}}', 'code', 'varchar(100) NOT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{rc_periods}}', 'code');
        $this->dropColumn('{{rc_subjects}}', 'code');
    }
}