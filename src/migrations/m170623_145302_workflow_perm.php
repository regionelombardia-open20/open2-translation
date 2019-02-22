<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\translation\migrations
 * @category   CategoryName
 */
use lispa\amos\core\migration\AmosMigrationPermissions;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m170623_145300_trans_wid_perm
 */
class m170623_145302_workflow_perm extends AmosMigrationPermissions {

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations() {
        return $this->setModelPermissions();
    }

    private function setModelPermissions() {
        return [
            [
                'name' => 'AmosTranslationWorkflow/DRAFT',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to translate',
                'parent' => ['TRANSLATE_MANAGER', 'TRANSLATOR'],
            ],
            [
                'name' => 'AmosTranslationWorkflow/TRANSLATED',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to translate',
                'parent' => ['TRANSLATE_MANAGER', 'TRANSLATOR'],
            ],
            [
                'name' => 'AmosTranslationWorkflow/TOBEREVIEWED',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to translate',
                'parent' => ['TRANSLATE_MANAGER', 'TRANSLATOR'],
            ],
            [
                'name' => 'AmosTranslationWorkflow/APPROVED',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to translate',
                'parent' => ['TRANSLATE_MANAGER', 'TRANSLATOR'],
            ],
        ];
    }

}
