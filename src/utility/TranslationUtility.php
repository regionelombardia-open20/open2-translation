<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */
/**
 */

namespace open20\amos\translation\utility;

/**
 * Class TranslationUtility
 * @package open20\amos\translation\utility
 */
class TranslationUtility
{
    public static function getAttributesToTranslate($namespace){
        $module = \Yii::$app->getModule('translation');
        $attributesToTranslate = [];

        if($module) {
            $models = (!empty($module->translationBootstrap['configuration']['translationContents']['models']) ?
                $module->translationBootstrap['configuration']['translationContents']['models']
                : []);

            foreach ((array)$models as $value) {
                if ($value['namespace'] == $namespace) {
                    $attributesToTranslate = $value['attributes'];
                }
            }
        }
        return $attributesToTranslate;
    }
}