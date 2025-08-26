<?php

/**
 * Currency install migration
 *
 * @category YupeMigration
 * @package  yupe.modules.currency.install.migrations
 * @author   Nikkable
 * @license
 * @link     https://vk.com/nikkable
 **/
class m000000_000000_currency_base extends yupe\components\DbMigration
{

    public function safeUp()
    {
        $this->createTable(
            '{{currency}}',
            [
                'id'            => 'pk',
                'name'         => 'varchar(250) NOT NULL',
                'slug'          => 'char(3) DEFAULT NULL',
                'status'        => "integer NOT NULL DEFAULT '0'",
                'coff'        => "decimal(6,2) NOT NULL DEFAULT '0'",

            ],
            $this->getOptions()
        );

        $this->createIndex("ux_{{currency}}_slug", '{{currency}}', "slug", true);
        $this->createIndex("ix_{{currency}}_status", '{{currency}}', "status", false);
    }

    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{currency}}');
    }
}
