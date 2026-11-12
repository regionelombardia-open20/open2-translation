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

namespace open20\amos\translation\rules;

use yii\web\ForbiddenHttpException;

class CanTranslateRule extends \yii\rbac\Rule {

    public $name = 'canTranslate';
    public $description = '';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params) {
        $languages = \open20\amos\translation\models\TranslationConf::getStaticAllActiveLanguages()->asArray()->all();
        $arrLanguages = [];
        foreach ($languages as $value) {
            $arrLanguages[] = $value['language_id'];
        }
        $ver = true;

        $langGet = filter_input(INPUT_GET, 'lang');
        $langGet2 = filter_input(INPUT_GET, 'language');
        if (!empty($langGet)) {
            if (!in_array($langGet, $arrLanguages)) {
                $ver = false;
            }
        }
        if (!empty($langGet2)) {
            if (!in_array($langGet2, $arrLanguages)) {
                $ver = false;
            }
        }
        $langGetTest = (in_array($langGet, $arrLanguages) ? $langGet : null);
        $langGetTest2 = (in_array($langGet2, $arrLanguages) ? $langGet2 : null);
        $current = \yii\helpers\Url::current();
        if ((!empty(\Yii::$app->getModule('translation')->defaultLanguage) && !empty($langGet) && $langGet == \Yii::$app->getModule('translation')->defaultLanguage && strpos(substr($current, 0, 40), '/translation/default/view-tr') === false) || (!empty(\Yii::$app->getModule('translation')->defaultLanguage) && !empty($langGet2) && $langGet2 == \Yii::$app->getModule('translation')->defaultLanguage) || (/* empty($langGet) && empty($langGet2) && */ (empty($langGetTest) && empty($langGetTest2)) && strpos(substr($current, 0, 40), '/translation/default/view-tr') === false && $ver == false)) {
            throw new ForbiddenHttpException(\Yii::t('amoscore', 'Access denied.'));
        } else {
            if (\Yii::$app->getUser()->can('TRANSLATE_MANAGER')) {
                return true;
            } else {
                if (!isset($params['model'])) {
                    $parasm['model'] = new \open20\amos\translation\models\TranslationUserLanguageMm();
                }
                if (isset($params['model'])) {
                    if ($params['model'] instanceof \open20\amos\translation\models\TranslationUserLanguageMm) {
                        /**  $model Models for translation */
                        $model = $params['model'];
                        if (!isset($model->user_id)) {
                            if (isset($_GET['user_id'])) {
                                $model = $this->instanceModel($model, $_GET['user_id']);
                            } else if (isset($_POST['user_id'])) {
                                $model = $this->instanceModel($model, $_POST['user_id']);
                            } else {
                                $model = $this->instanceModel($model, $user);
                            }
                        }
                        if (!isset($params['language'])) {
                            if (isset($_GET['language'])) {
                                $params['language'] = $_GET['language'];
                            } else if (isset($_POST['language'])) {
                                $params['language'] = $_POST['language'];
                            } else if (isset($_GET['lang'])) {
                                $params['language'] = $_GET['lang'];
                            } else if (isset($_POST['lang'])) {
                                $params['language'] = $_POST['lang'];
                            }
                        }
                        if (isset($params['language']) && isset($user)) {
                            $hasLanguage = $model->findOne(['user_id' => $user, 'language' => $params['language']]);
                            if ($hasLanguage) {
                                return true;
                            }
                        }
                    } else {
                        $model = $params['model'];
                        if (!isset($params['language'])) {
                            if (isset($_GET['language'])) {
                                $params['language'] = $_GET['language'];
                            } else if (isset($_POST['language'])) {
                                $params['language'] = $_POST['language'];
                            } else if (isset($_GET['lang'])) {
                                $params['language'] = $_GET['lang'];
                            } else if (isset($_POST['lang'])) {
                                $params['language'] = $_POST['lang'];
                            }
                        }
                        $languageField = \Yii::$app->getModule('translation')->languageField;
                        if (isset($model->{$languageField}) && !empty($user)) {
                            $hasLanguage = \open20\amos\translation\models\TranslationUserLanguageMm::findOne(['user_id' => $user, 'language' => $model->{$languageField}]);
                            if ($hasLanguage) {
                                return true;
                            }
                        } else if (!empty($params['language']) && !empty($user)) {
                            $hasLanguage = \open20\amos\translation\models\TranslationUserLanguageMm::findOne(['user_id' => $user, 'language' => $params['language']]);
                            if ($hasLanguage) {
                                return true;
                            }
                        }
                    }
                    return false;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    /**
     * @param TranslationUserLanguageMm $model
     * @param int $modelId
     * @return mixed
     */
    private function instanceModel($model, $modelId) {
        $instancedModel = $model->findOne($modelId);
        if (!is_null($instancedModel)) {
            $model = $instancedModel;
        }
        return $model;
    }

}
