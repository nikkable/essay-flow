<?php

class m210000_200000_store_author_payments_base extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->createTable(
            "{{store_author_payments}}",
            [
                "author_id" => "integer",
                "created_at" => "datetime",
                "updated_at" => "datetime",
                "cart_number" => "varchar(255) not null default ''",
                "cart_name" => "varchar(255) not null default ''",
                "currency" => "varchar(3) not null default ''",
                "hold" => "decimal(10, 2) not null default '0'",
                "paid" => "decimal(10, 2) not null default '0'",
            ],
            $this->getOptions()
        );

        $this->createIndex("idx_{{store_author_payments}}_author_id", "{{store_author_payments}}", "author_id");

        //fk
        $this->addForeignKey("fk_{{store_author_payments}}_user", "{{store_author_payments}}", "author_id", "{{user_user}}", "id", "SET NULL", "CASCADE");
    }

    public function safeDown()
    {
        $this->dropTable("{{store_author_payments}}");
    }
}
