<?php

use lispa\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

class m180717_150930_trigger_delete_language_translate extends \yii\db\Migration
{

    const TABLE = '{{%translation_conf}}';

    public function safeUp()
    {

    $this->execute("
        CREATE TRIGGER delete_preferences_language AFTER DELETE ON language_translate
        FOR EACH ROW
        DELETE FROM `language_translate_user_fields`
        WHERE language_translate_user_fields.language_translate_id = OLD.id
            AND language_translate_user_fields.language_translate_language = OLD.language");
    return true;
    }

    public function safeDown()
    {
      $this->execute("DROP TRIGGER delete_preferences_language");
    }

}
