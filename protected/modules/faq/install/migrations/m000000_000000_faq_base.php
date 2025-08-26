<?php

/**
 * FAQ install migration
 *
 * @category YupeMigration
 * @package  yupe.modules.faq.install.migrations
 * @author   Nikkable
 * @license
 * @link     https://vk.com/nikkable
 **/
class m000000_000000_faq_base extends yupe\components\DbMigration
{

    public function safeUp()
    {
        $this->createTable(
            '{{faq}}',
            [
                'id'            => 'pk',
                'lang'          => 'char(2) DEFAULT NULL',
                'create_time' => 'datetime NOT NULL',
                'update_time'   => 'datetime NOT NULL',
                'date'          => 'date NOT NULL',
                'title'         => 'varchar(250) NOT NULL',
                'slug'         => 'varchar(150) NOT NULL',
                'short_text'    => 'text',
                'full_text'     => 'text NOT NULL',
                'image'         => 'varchar(300) DEFAULT NULL',
                'status'        => "integer NOT NULL DEFAULT '0'",
                'description'   => 'varchar(250) NOT NULL',
                'badge'   => 'string',
                'badge_color'   => 'string',
                'field'   => 'text',
            ],
            $this->getOptions()
        );

        $this->createIndex("ux_{{faq}}_slug_lang", '{{faq}}', "slug,lang", true);
        $this->createIndex("ix_{{faq}}_status", '{{faq}}', "status", false);
        $this->createIndex("ix_{{faq}}_date", '{{faq}}', "date", false);
    }

    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{faq}}');
    }
}
