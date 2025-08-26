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
class m161008_000000_user_rename_column_author_verification_status extends CDbMigration
{
    public function up()
    {
        $this->alterColumn('{{user_user}}', 'author_verification_status', 'int(1) DEFAULT NULL');
    }

    public function down()
    {
        $this->alterColumn('{{user_user}}', 'author_verification_status', 'int(1) DEFAULT 0');
    }
}
