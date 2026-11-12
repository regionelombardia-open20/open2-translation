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

/**
 * Class m170612_150031_translation_workflow
 */
class m170612_150031_translation_workflow extends \yii\db\Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $this->execute("
            INSERT INTO `sw_workflow` (`id`, `initial_status_id`) VALUES
            ('AmosTranslationWorkflow', 'DRAFT');
            
            INSERT INTO `sw_transition` (`workflow_id`, `start_status_id`, `end_status_id`) VALUES
            ('AmosTranslationWorkflow', 'APPROVED', 'DRAFT'),
            ('AmosTranslationWorkflow', 'APPROVED', 'TOBEREVIEWED'),
            ('AmosTranslationWorkflow', 'DRAFT', 'TRANSLATED'),
            ('AmosTranslationWorkflow', 'TOBEREVIEWED', 'TRANSLATED'),
            ('AmosTranslationWorkflow', 'TRANSLATED', 'APPROVED'),
            ('AmosTranslationWorkflow', 'TRANSLATED', 'TOBEREVIEWED');
            
            INSERT INTO `sw_status` (`id`, `workflow_id`, `label`, `sort_order`) VALUES
            ('APPROVED', 'AmosTranslationWorkflow', 'Approved', 4),
            ('DRAFT', 'AmosTranslationWorkflow', 'Draft', 1),
            ('TOBEREVIEWED', 'AmosTranslationWorkflow', 'To be reviewed', 3),
            ('TRANSLATED', 'AmosTranslationWorkflow', 'Translated', 2);

            INSERT INTO `sw_metadata` (`workflow_id`, `status_id`, `key`, `value`) VALUES
            ('AmosTranslationWorkflow', 'APPROVED', 'label', 'Approved'),
            ('AmosTranslationWorkflow', 'DRAFT', 'label', 'Draft');
                ");

        $this->execute("SET FOREIGN_KEY_CHECKS=1;");
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "No migration dows available for m170612_150031_translation_workflow";
        return true;
    }
}
