<?php

class m181220_121815_store_product_add_column extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'periods_id', 'integer null');
        $this->addColumn('{{store_product}}', 'subjects_id', 'integer null');
        $this->addColumn('{{store_product}}', 'words_id', 'integer null');

        $this->addForeignKey("fk_{{store_product}}_periods", "{{store_product}}", "periods_id",
            "{{rc_periods}}", "id", "CASCADE", "CASCADE");
        $this->addForeignKey("fk_{{store_product}}_subjects", "{{store_product}}", "subjects_id",
            "{{rc_subjects}}", "id", "CASCADE", "CASCADE");
        $this->addForeignKey("fk_{{store_product}}_words", "{{store_product}}", "words_id",
            "{{rc_words}}", "id", "CASCADE", "CASCADE");
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'periods_id');
        $this->dropColumn('{{store_product}}', 'subjects_id');
        $this->dropColumn('{{store_product}}', 'words_id');
    }
}