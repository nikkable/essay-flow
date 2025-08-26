<?php

class m200424_143324_add_order_coff_and_currency_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_order}}', 'currency', 'char(3) DEFAULT NULL');
        $this->addColumn('{{store_order}}', 'coff', "decimal(6,2) NOT NULL DEFAULT '0'");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_order}}', 'currency');
        $this->dropColumn('{{store_order}}', 'coff');
    }
}