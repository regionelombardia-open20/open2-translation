<?php

use lispa\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

class m170613_145155_permission_translation extends AmosMigrationPermissions
{
    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = [            
            [
                'name' => 'CanTranslateRule',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Rule to translate',
                'ruleName' => \lispa\amos\translation\rules\CanTranslateRule::className(), 
                'parent' => ['CONTENT_TRANSLATOR']
            ],
            [
                'name' => 'TRANSLATOR',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to translate',
                'ruleName' => null,
                'parent' => ['CanTranslateRule']
            ],            
        ];
    }
}