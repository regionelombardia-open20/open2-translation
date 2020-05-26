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

namespace open20\amos\translation\models\search;


use open20\amos\translation\utility\TranslationUtility;
use yii\base\Model;

class TranslationSearch extends Model
{
    public $isTranslated;
    public $attributes;
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['isTranslated','attributes'], 'safe'],
        ];
    }

}