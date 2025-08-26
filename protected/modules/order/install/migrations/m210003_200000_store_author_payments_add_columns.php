<?php

class m210003_200000_store_author_payments_add_columns extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_author_payments}}', 'expiry_month', 'integer');
        $this->addColumn('{{store_author_payments}}', 'expiry_year', 'integer');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_author_payments}}', 'expiry_month');
        $this->dropColumn('{{store_author_payments}}', 'expiry_year');
    }
}
