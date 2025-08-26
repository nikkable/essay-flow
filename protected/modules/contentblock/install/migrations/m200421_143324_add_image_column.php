<?php

class m200421_143324_add_image_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{contentblock_content_block}}', 'image', 'string');
    }
    public function safeDown()
    {
       $this->dropColumn('{{contentblock_content_block}}', 'image');
    }
}