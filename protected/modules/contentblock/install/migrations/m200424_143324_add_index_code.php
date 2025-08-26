<?php

class m200424_143324_add_index_code extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->dropIndex('ux_{{contentblock_content_block}}_code', '{{contentblock_content_block}}');
//        $this->createIndex("ui_{{contentblock_content_block}}_code", '{{contentblock_content_block}}', "code", false);
    }

    public function safeDown()
    {
//        $this->createIndex("ux_{{contentblock_content_block}}_code", '{{contentblock_content_block}}', "code", true);
    }
}