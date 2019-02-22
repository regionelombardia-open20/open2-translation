<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\admin\migrations
 * @category   CategoryName
 */

use lispa\amos\admin\models\UserProfileArea;
use yii\db\Migration;

/**
 * Class m181012_162615_add_user_profile_area_field_1
 */
class m181108_161715_regroup_widgets_translation extends Migration
{



    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update('amos_widgets', ['dashboard_visible' => 0, 'child_of' => 'lispa\amos\dashboard\widgets\icons\WidgetIconManagement'], ['classname' => 'lispa\amos\translation\widgets\icons\WidgetIconTranslation']);


    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->update('amos_widgets', ['dashboard_visible' => 1, 'child_of' => null], ['classname' => 'lispa\amos\translation\widgets\icons\WidgetIconTranslation']);
    }
}
