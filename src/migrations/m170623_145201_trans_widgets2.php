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
class m170623_145201_trans_widgets2 extends AmosMigrationWidgets
{
    const MODULE_NAME = 'translation';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \lispa\amos\translation\widgets\icons\WidgetIconTrTranslators::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \lispa\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'default_order' => 70
            ],           
        ];
    }
}
