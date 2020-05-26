<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */
use open20\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


/**
* Class m190104_102316_clean_cache_permissions_widgets*/
class m190104_102316_clean_cache_permissions_widgets extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' => \open20\amos\translation\widgets\icons\WidgetIconTrCleanCache::className(),
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permission widget clean cache',
                    'ruleName' => null,
                    'parent' => ['CONTENT_TRANSLATOR','TRANSLATION_ADMINISTRATOR']
                ],
            ];
    }
}
