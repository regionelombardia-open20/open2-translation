<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos-translation
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

use Yii;

/**
 * This is the base-model class for table "translation_user_language_mm".
 *
 * @property integer $user_id
 * @property string $language
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \backend\models\Language $language0
 * @property \backend\models\User $user
 */
class TranslationUserLanguageMm extends \open20\amos\core\record\Record {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'translation_user_language_mm';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id'], 'required'],
            [['user_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['language'], 'safe'],
            [['user_id', 'language'], 'unique', 'targetAttribute' => ['user_id', 'language']],
            [['language'], 'exist', 'skipOnError' => true, 'targetClass' => \lajax\translatemanager\models\Language::className(), 'targetAttribute' => ['language' => 'language_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \open20\amos\core\user\User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'user_id' => Yii::t('amostranslation', 'User ID'),
            'language' => Yii::t('amostranslation', 'Language'),
            'created_at' => Yii::t('amostranslation', 'Created At'),
            'updated_at' => Yii::t('amostranslation', 'Updated At'),
            'deleted_at' => Yii::t('amostranslation', 'Deleted At'),
            'created_by' => Yii::t('amostranslation', 'Created By'),
            'updated_by' => Yii::t('amostranslation', 'Updated By'),
            'deleted_by' => Yii::t('amostranslation', 'Deleted By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage0() {
        return $this->hasOne(\lajax\translatemanager\models\Language::className(), ['language_id' => 'language']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(\open20\amos\core\user\User::className(), ['id' => 'user_id']);
    }

}
