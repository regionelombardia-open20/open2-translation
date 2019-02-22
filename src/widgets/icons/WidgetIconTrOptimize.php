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

class WidgetIconTrOptimize extends WidgetIcon
{

    public function init()
    {
        parent::init();

        $this->setLabel(AmosTranslation::tHtml('amostranslation', 'Optimize'));
        $this->setDescription(AmosTranslation::t('amostranslation', 'Optimize tables'));

        $this->setIcon('translate');
        $this->setIconFramework('am');

        $this->setUrl(Yii::$app->urlManager->createUrl(['/translatemanager/language/optimizer']));
        $this->setCode('TRANSLATION_OPTIMIZE');
        $this->setModuleName('translation');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-grey'
        ]));

    }

}