<?php
class m170732_092830_add_column_lang_table extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{rc_periods}}', 'lang', 'char(2) DEFAULT NULL');
        $this->addColumn('{{rc_subjects}}', 'lang', 'char(2) DEFAULT NULL');
        $this->addColumn('{{rc_words}}', 'lang', 'char(2) DEFAULT NULL');

        $this->createIndex("ux_{{rc_periods}}_lang", '{{rc_periods}}', "lang", false);
        $this->createIndex("ux_{{rc_subjects}}_lang", '{{rc_subjects}}', "lang", false);
        $this->createIndex("ux_{{rc_words}}_lang", '{{rc_subjects}}', "lang", false);
    }

    public function safeDown()
    {
        $this->dropColumn('{{rc_periods}}', 'lang');
        $this->dropColumn('{{rc_subjects}}', 'lang');
        $this->dropColumn('{{rc_words}}', 'lang');
    }
}