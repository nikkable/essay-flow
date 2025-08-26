<?php

class m150127_130426_add_content_column extends \yupe\components\DbMigration
{
    public function up()
    {
        $this->addColumn('{{contentblock_content_block}}', 'content2', 'text');
        $this->addColumn('{{contentblock_content_block}}', 'content3', 'text');
        $this->addColumn('{{contentblock_content_block}}', 'content4', 'text');
    }

    public function down()
    {
        $this->dropColumn('{{contentblock_content_block}}', 'content2');
        $this->dropColumn('{{contentblock_content_block}}', 'content3');
        $this->dropColumn('{{contentblock_content_block}}', 'content4');
    }
}