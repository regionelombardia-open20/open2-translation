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
use lispa\amos\dashboard\models\AmosWidgets;
use lispa\amos\translation\AmosTranslation;

class WidgetIconTranslation extends WidgetIcon
{

    public function init()
    {
        parent::init();

        $this->setLabel(AmosTranslation::tHtml('amostranslation', 'Translations'));
        $this->setDescription(AmosTranslation::t('amostranslation', 'Plugin Translation'));

        $this->setIcon('translate');
        $this->setIconFramework('am');

        $this->setUrl(Yii::$app->urlManager->createUrl(['/translation']));
        $this->setCode('TRANSLATE_MANAGER');
        $this->setModuleName('translation');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-lightPrimary'
        ]));

    }

    public function getOptions()
    {
        $options = parent::getOptions();

        //aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
        return ArrayHelper::merge($options, ["children" => $this->getWidgetsIcon()]);
    }

   public function getWidgetsIcon()
    {
        return AmosWidgets::find()
            ->andWhere([
                'child_of' => self::className()
            ])->all();
    }
}