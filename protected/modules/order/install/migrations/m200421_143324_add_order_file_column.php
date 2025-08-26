<?php

class m200421_143324_add_order_file_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_order}}', 'file', 'string');
    }
    public function safeDown()
    {
       $this->addColumn('{{store_order}}', 'file', 'string');
    }
}