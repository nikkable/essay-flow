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
class m161007_000000_user_add_fields extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{user_user}}', 'subjects', 'VARCHAR(1000) DEFAULT NULL');
        $this->addColumn('{{user_user}}', 'skills', 'string');
        $this->addColumn('{{user_user}}', 'linked', 'VARCHAR(1000) DEFAULT NULL');
        $this->addColumn('{{user_user}}', 'file', 'string');
        $this->addColumn('{{user_user}}', 'author_verification_status', 'int DEFAULT 0');
    }

    public function safeDown()
    {
        $this->dropColumn('{{user_user}}', 'subjects');
        $this->dropColumn('{{user_user}}', 'skills');
        $this->dropColumn('{{user_user}}', 'linked');
        $this->dropColumn('{{user_user}}', 'file');
        $this->dropColumn('{{user_user}}', 'author_verification_status');
    }
}
