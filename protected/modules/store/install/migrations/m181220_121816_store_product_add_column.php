<?php

class m181220_121816_store_product_add_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'language_id', 'integer null');

        $this->addForeignKey("fk_{{store_product}}_language", "{{store_product}}", "language_id",
            "{{rc_language}}", "id", "CASCADE", "CASCADE");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'language_id');
    }
}