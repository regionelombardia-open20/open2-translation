<?php
/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\chat
 * @category   CategoryName
 */

namespace lispa\amos\translation\assets;

use yii\web\AssetBundle;

/**
 * Class AmosChatAsset
 * @package lispa\amos\chat\assets
 */
class AmosTranslationAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/lispa/amos-translation/src/assets/web';

    /**
     * @var array
     */
    public $css = [
        'css/style.css',
    ];

    /**
     * @var array
     */
    public $js = [];

    /**
     * @var array
     */
    public $depends = [
        'lispa\amos\core\views\assets\AmosCoreAsset',
    ];
}