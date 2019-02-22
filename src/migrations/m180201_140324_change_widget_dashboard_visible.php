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

/**
 * Class m180201_140324_change_widget_dashboard_visible
 */
class m180201_140324_change_widget_dashboard_visible extends AmosMigrationWidgets
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
                'dashboard_visible' => 1,
                'update' => true
            ]
        ];
    }
}
