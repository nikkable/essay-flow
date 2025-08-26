<?php

class m181215_110528_drop_index extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->dropIndex('ux_yupe_menu_menu_code', '{{menu_menu}}');
    }

    public function safeDown()
    {
    }
}