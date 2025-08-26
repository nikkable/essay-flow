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
class m161009_000000_user_add_languages_field extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{user_user}}', 'languages', 'VARCHAR(1000) DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{user_user}}', 'languages');
    }
}
