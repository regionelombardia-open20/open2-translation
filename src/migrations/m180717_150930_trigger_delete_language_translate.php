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
 * Class m180717_150930_trigger_delete_language_translate
 */
class m180717_150930_trigger_delete_language_translate extends \yii\db\Migration
{
    const TABLE = '{{%translation_conf}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $this->execute("
        CREATE TRIGGER delete_preferences_language AFTER DELETE ON language_translate
        FOR EACH ROW
        DELETE FROM `language_translate_user_fields`
        WHERE language_translate_user_fields.language_translate_id = OLD.id
            AND language_translate_user_fields.language_translate_language = OLD.language");
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->execute("DROP TRIGGER delete_preferences_language");
    }
}
