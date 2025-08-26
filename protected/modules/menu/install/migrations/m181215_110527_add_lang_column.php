<?php

class m181215_110527_add_lang_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{menu_menu}}', 'lang', 'char(2) DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{menu_menu}}', 'lang');
    }
}