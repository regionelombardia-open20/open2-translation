<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\translation
 * @category   CategoryName
 */
use lispa\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m180131_164230_translation_user_preference_permissions
 */
class m180131_164230_translation_user_preference_permissions extends AmosMigrationPermissions
{

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
            [
                'name' => 'TRANSLATIONUSERPREFERENCE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model TranslationUserPreference',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'TRANSLATIONUSERPREFERENCE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model TranslationUserPreference',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'TRANSLATIONUSERPREFERENCE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model TranslationUserPreference',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'TRANSLATIONUSERPREFERENCE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model TranslationUserPreference',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
        ];
    }
}