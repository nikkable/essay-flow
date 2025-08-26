<?php

class m200422_143324_add_order_tax_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_order}}', 'tax', 'decimal(6,2)');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_order}}', 'tax');
    }
}