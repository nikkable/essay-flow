<?php

class m170733_092840_create_language_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->createTable(
            '{{rc_language}}',
            [
                'id'           => 'pk',
                'name'         => 'string COMMENT "Name"',
                'cost'         => 'decimal(6,2) COMMENT "Price"',
                'lang'         => 'char(2) DEFAULT NULL',
                'code'         => 'string NOT NULL',
            ],
            $this->getOptions()
        );

        $this->createIndex("ux_{{rc_language}}_name", '{{rc_language}}', "name", false);
        $this->createIndex("ux_{{rc_language}}_lang", '{{rc_language}}', "lang", false);
        $this->createIndex("ux_{{rc_language}}_code", '{{rc_language}}', "code", false);
    }

    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{rc_language}}');
    }
}