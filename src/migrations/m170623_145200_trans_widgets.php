<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\translation\migrations
 * @category   CategoryName
 */

use lispa\amos\core\migration\AmosMigrationWidgets;
use lispa\amos\dashboard\models\AmosWidgets;

/**
 * Class m170623_145200_trans_widgets
 */
class m170623_145200_trans_widgets extends AmosMigrationWidgets
{
    const MODULE_NAME = 'translation';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \lispa\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => null,       
                'default_order' => 10
            ],
            [
                'classname' => \lispa\amos\translation\widgets\icons\WidgetIconTrContents::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \lispa\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'default_order' => 20
            ],
            [
                'classname' => \lispa\amos\translation\widgets\icons\WidgetIconTrPlatform::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \lispa\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'default_order' => 30
            ],
            [
                'classname' => \lispa\amos\translation\widgets\icons\WidgetIconTrLanguage::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \lispa\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'default_order' => 40
            ],
            [
                'classname' => \lispa\amos\translation\widgets\icons\WidgetIconTrOptimize::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \lispa\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'default_order' => 50
            ],            
            [
                'classname' => \lispa\amos\translation\widgets\icons\WidgetIconTrScan::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \lispa\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'default_order' => 60
            ],            
        ];
    }
}
