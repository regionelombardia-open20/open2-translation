<?php

use lispa\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

class m170613_150034_permission_translation_administration extends \yii\db\Migration
{

    public function safeUp()
    {
        $roleAdmin = Yii::$app->authManager->getRole('ADMIN');
        $permTranslAdm = Yii::$app->authManager->getPermission('TRANSLATION_ADMINISTRATOR');
        if(!(Yii::$app->authManager->hasChild($roleAdmin, $permTranslAdm))) {
            Yii::$app->authManager->addChild($roleAdmin,$permTranslAdm);
        }
    }

    public function safeDown()
    {
        $roleAdmin = Yii::$app->authManager->getRole('ADMIN');
        $permTranslAdm = Yii::$app->authManager->getPermission('TRANSLATION_ADMINISTRATOR');
        Yii::$app->authManager->removeChild($roleAdmin,$permTranslAdm);
    }

}
