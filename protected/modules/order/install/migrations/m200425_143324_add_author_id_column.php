<?php

class m200425_143324_add_author_id_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_order}}', 'author_id', 'integer null');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_order}}', 'author_id');
    }
}