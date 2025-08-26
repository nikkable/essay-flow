<?php
/**
 * Добавляем параметр "телефон"
 *
 * @category YupeMigration
 * @package  yupe.modules.user.install.migrations
 * @author   YupeTeam <support@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     https://yupe.ru
 **/
class m151007_000000_user_add_address_fields extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{user_user}}', 'street', 'VARCHAR(255)');
        $this->addColumn('{{user_user}}', 'zipcode', 'VARCHAR(30)');
        $this->addColumn('{{user_user}}', 'country', 'VARCHAR(150)');
        $this->addColumn('{{user_user}}', 'city', 'string');
        $this->addColumn('{{user_user}}', 'house', 'VARCHAR(50)');
        $this->addColumn('{{user_user}}', 'apartment', 'VARCHAR(10)');
    }

    public function safeDown()
    {
        $this->dropColumn('{{user_user}}', 'street');
        $this->dropColumn('{{user_user}}', 'zipcode');
        $this->dropColumn('{{user_user}}', 'country');
        $this->dropColumn('{{user_user}}', 'city');
        $this->dropColumn('{{user_user}}', 'house');
        $this->dropColumn('{{user_user}}', 'apartment');
    }
}
