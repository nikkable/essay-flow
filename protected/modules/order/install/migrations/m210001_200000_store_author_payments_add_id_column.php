<?php

class m210001_200000_store_author_payments_add_id_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_author_payments}}', 'id', 'pk');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_author_payments}}', 'id');
    }
}
