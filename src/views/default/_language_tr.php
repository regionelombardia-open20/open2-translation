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

use open20\amos\core\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use open20\amos\translation\AmosTranslation;
use open20\amos\translation\models\TranslationConf;

?>
<div class="search">

    <?php 
    $form = ActiveForm::begin([
                'action' => ['view-tr', 'id' => filter_input(INPUT_GET, 'id'), 'lang' => filter_input(INPUT_GET, 'lang'), 'namespace' => filter_input(INPUT_GET, 'namespace'), 'url' => filter_input(INPUT_GET, 'url')],
                'method' => 'get',
                'options' => [
                    'data-pjax' => true,
                    'id' => 'filter_lang',
                    'class' => 'default-form',
                ]
    ]);
    ?>    
    <div class="container" id="container-filter">
    <div class="col-md-6">
        <p>
            <strong>    
                <?= $model->getAttributeLabel('language_source') ?>
            </strong>
                <?=
                        $form->field($model, 'language_source')
                        ->dropDownList(\yii\helpers\ArrayHelper::map(TranslationConf::getStaticAllActiveLanguages(true, filter_input(INPUT_GET, 'namespace'))->andWhere(['!=', 'language_id', filter_input(INPUT_GET, 'lang')])->orderBy('language_id')->all(), 'language_id', 'language_id'), ['prompt' => AmosTranslation::t('amostranslation', 'Source contents {lang}', ['lang' => (isset($this->context->module->defaultLanguage)? '(' . $this->context->module->defaultLanguage . ')' : '')]), 'id' => 'source_lang_id'])
                        ->label(false);
                ?>             
            
        </p>
    </div>

    <div class="col-md-6 m-t-30">                 
            <?= Html::submitButton(AmosTranslation::tHtml('amostranslation', 'Change source language'), ['class' => 'btn btn-navigation-primary']) ?>      
    </div>
    </div>
    <div class="clearfix"></div> 
    <?php
    ActiveForm::end();
    ?>
</div>