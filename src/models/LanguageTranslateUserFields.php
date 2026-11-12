<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\translation\models
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

namespace open20\amos\translation\models;

use open20\amos\translation\AmosTranslation;
use yii\db\ActiveRecord;

/**
 * Class LanguageTranslateUserFields
 *
 * This is the model class for table "language_translate_user_fields".
 *
 * @property integer $id
 * @property integer $language_translate_id
 * @property string $language_translate_language
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @package open20\amos\translation\models
 */
class LanguageTranslateUserFields extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language_translate_user_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language_translate_id', 'language_translate_language'], 'required'],
            [['language_translate_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['language_translate_language'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosTranslation::t('amostranslation', 'ID'),
            'language_translate_id' => AmosTranslation::t('amostranslation', 'Language Translate ID'),
            'language_translate_language' => AmosTranslation::t('amostranslation', 'Language Translate Language'),
            'created_at' => AmosTranslation::t('amostranslation', 'Created at'),
            'updated_at' => AmosTranslation::t('amostranslation', 'Updated at'),
            'deleted_at' => AmosTranslation::t('amostranslation', 'Deleted at'),
            'created_by' => AmosTranslation::t('amostranslation', 'Created by'),
            'updated_by' => AmosTranslation::t('amostranslation', 'Updated by'),
            'deleted_by' => AmosTranslation::t('amostranslation', 'Deleted by')
        ];
    }
}
