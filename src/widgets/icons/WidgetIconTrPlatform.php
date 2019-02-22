<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\translation
 * @category   CategoryName
 */

namespace lispa\amos\translation\widgets\icons;

use lispa\amos\core\widget\WidgetIcon;
use Yii;
use yii\helpers\ArrayHelper;
use lispa\amos\translation\AmosTranslation;

class WidgetIconTrPlatform extends WidgetIcon
{

    public function init()
    {
        parent::init();

        $this->setLabel(AmosTranslation::tHtml('amostranslation', 'Translate platform'));
        $this->setDescription(AmosTranslation::t('amostranslation', 'Translate platform'));

        $this->setIcon('translate');
        $this->setIconFramework('am');

        $this->setUrl(Yii::$app->urlManager->createUrl(['/translatemanager/language/list']));
        $this->setCode('TRANSLATE_PLATFORM');
        $this->setModuleName('translation');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-primary'
        ]));

    }
   
}