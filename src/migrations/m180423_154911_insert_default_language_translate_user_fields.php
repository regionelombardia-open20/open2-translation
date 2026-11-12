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

use open20\amos\translation\AmosTranslation;
use open20\amos\translation\models\LanguageTranslateUserFields;
use yii\db\ActiveRecord;
use yii\db\Migration;
use yii\db\Query;

/**
 * Class m180423_154911_insert_default_language_translate_user_fields
 */
class m180423_154911_insert_default_language_translate_user_fields extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        /** @var AmosTranslation $translationModule */
        $translationModule = Yii::$app->getModule(AmosTranslation::getModuleName());
        /** @var ActiveRecord $className */
        $className = $translationModule->modelOwnerPlatformTranslation;
        $query = new Query();
        $query->from($className::tableName());
        $allTranslations = $query->all();
        foreach ($allTranslations as $translation) {
            $langTranslateUserFieldsQuery = new Query();
            $langTranslateUserFieldsQuery->from(LanguageTranslateUserFields::tableName());
            $langTranslateUserFieldsQuery->andWhere([
                'language_translate_id' => $translation[$translationModule->modelOwnerPlatformTrIdField],
                'language_translate_language' => $translation[$translationModule->modelOwnerPlatformTrLanguageField]
            ]);
            $exists = $langTranslateUserFieldsQuery->exists();
            if (!$exists) {
                $now = date('Y-m-d H:i:s');
                $this->insert(LanguageTranslateUserFields::tableName(), [
                    'language_translate_id' => $translation[$translationModule->modelOwnerPlatformTrIdField],
                    'language_translate_language' => $translation[$translationModule->modelOwnerPlatformTrLanguageField],
                    'created_at' => $now,
                    'created_by' => 1,
                    'updated_at' => $now,
                    'updated_by' => 1
                ]);
            }
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180423_154911_insert_default_language_translate_user_fields cannot be reverted.\n";
        return false;
    }
}
