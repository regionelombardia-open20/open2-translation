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

class WidgetIconTrContents extends WidgetIcon
{
    public function init()
    {
        parent::init();

        $this->setLabel(AmosTranslation::tHtml('amostranslation', 'Translate contents'));
        $this->setDescription(AmosTranslation::t('amostranslation', 'Translate contents'));

        $this->setIcon('translate');
        $this->setIconFramework('am');

        $this->setUrl(Yii::$app->urlManager->createUrl(['/translation/default/contents']));
        $this->setCode('TRANSLATE_CONTENTS');
        $this->setModuleName('translation');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-primary'
        ]));        
    }
   
}