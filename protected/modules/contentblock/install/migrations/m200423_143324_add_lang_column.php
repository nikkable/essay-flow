<?php

class m200423_143324_add_lang_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{contentblock_content_block}}', 'lang', 'char(2) DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{contentblock_content_block}}', 'lang');
    }
}