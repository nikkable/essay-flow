<?php

class m170728_092829_add_tables_to_module extends yupe\components\DbMigration
{
	public function safeUp()
	{
        // Periods
        $this->createTable(
            '{{rc_periods}}',
            [
                'id'        => 'pk',
                'name'      => 'string COMMENT "Name"',
                'desc'      => 'string COMMENT "Description"',
                'cost' => 'decimal(6,2) COMMENT "Price"',
            ],
            $this->getOptions()
        );

        $this->createIndex("ix_{{rc_periods}}_name", '{{rc_periods}}', "name", false);

        // Subjects
        $this->createTable(
            '{{rc_subjects}}',
            [
                'id'           => 'pk',
                'name'         => 'string COMMENT "Name"',
                'cost'         => 'decimal(6,2) COMMENT "Price"',
            ],
            $this->getOptions()
        );

        $this->createIndex("ix_{{rc_subjects}}_name", '{{rc_subjects}}', "name", false);

        // Number of words
        $this->createTable(
            '{{rc_words}}',
            [
                'id'           => 'pk',
                'name'         => 'string COMMENT "Name"',
                'cost'         => 'decimal(6,2) COMMENT "Price"',
            ],
            $this->getOptions()
        );

        $this->createIndex("ix_{{rc_words}}_name", '{{rc_words}}', "name", false);
	}

	public function safeDown()
	{
        $this->dropTableWithForeignKeys('{{rc_periods}}');
        $this->dropTableWithForeignKeys('{{rc_subjects}}');
        $this->dropTableWithForeignKeys('{{rc_words}}');
	}
}