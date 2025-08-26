<?php

class m200423_143324_add_order_terms_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_order}}', 'terms', 'integer null');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_order}}', 'terms');
    }
}