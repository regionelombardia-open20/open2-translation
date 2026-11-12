<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\translation\migrations
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */

use open20\amos\core\migration\AmosMigrationPermissions;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m170623_145300_trans_wid_perm
 */
class m170623_145300_trans_wid_perm extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setPluginRoles(), $this->setModelPermissions(), $this->setWidgetsPermissions()
        );
    }

    private function setPluginRoles()
    {
        return [
            [
                'name' => 'TRANSLATE_MANAGER',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Administrator role for translation plugin',
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'CONTENT_TRANSLATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Content translator role for Translation plugin',
                'parent' => ['ADMIN']
            ]
        ];
    }

    private function setModelPermissions()
    {
        return [
            [
                'name' => 'TRANSLATOR',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to translate',
                'parent' => ['TRANSLATE_MANAGER'],
                'dontRemove' => true,
            ],
            [
                'name' => 'TRANSLATION_ADMINISTRATOR',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to translate',
                'parent' => ['TRANSLATE_MANAGER'],
                'dontRemove' => true,
            ],
        ];
    }

    private function setWidgetsPermissions()
    {
        $prefixStr = 'Permissions for the dashboard for the widget ';
        return [
            [
                'name' => \open20\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTranslation',
                'parent' => ['TRANSLATE_MANAGER', 'CONTENT_TRANSLATOR']
            ],
            [
                'name' => \open20\amos\translation\widgets\icons\WidgetIconTrContents::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTrContents',
                'parent' => ['TRANSLATE_MANAGER', 'CONTENT_TRANSLATOR']
            ],
            [
                'name' => \open20\amos\translation\widgets\icons\WidgetIconTrPlatform::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTrPlatform',
                'parent' => ['TRANSLATE_MANAGER', 'CONTENT_TRANSLATOR']
            ],
            [
                'name' => \open20\amos\translation\widgets\icons\WidgetIconTrLanguage::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTrLanguage',
                'parent' => ['TRANSLATE_MANAGER']
            ],
            [
                'name' => \open20\amos\translation\widgets\icons\WidgetIconTrOptimize::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTrOptimize',
                'parent' => ['TRANSLATE_MANAGER']
            ],
            [
                'name' => \open20\amos\translation\widgets\icons\WidgetIconTrScan::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTrScan',
                'parent' => ['TRANSLATE_MANAGER']
            ],
        ];
    }
}
