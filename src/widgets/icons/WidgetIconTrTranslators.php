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

class WidgetIconTrTranslators extends WidgetIcon
{

    public function init()
    {
        parent::init();

        $this->setLabel(AmosTranslation::tHtml('amostranslation', 'Manage translators'));
        $this->setDescription(AmosTranslation::t('amostranslation', 'Manage translators'));

        $this->setIcon('translate');
        $this->setIconFramework('am');

        $this->setUrl(Yii::$app->urlManager->createUrl(['/translation/default/translators']));
        $this->setCode('TRANSLATION_USERS');
        $this->setModuleName('translation');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-grey'
        ]));

    }

}