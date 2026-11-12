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
?>
<div class="search">

    <?php   
    $form = ActiveForm::begin([
                'action' => ['contents'],
                'method' => 'get',               
                'options' => [
                    'class' => 'default-form',                   
                ]
    ]);
    ?>    
    <div class="col-md-4 m-t-30">        
        <p>
            <strong>
                <?= AmosTranslation::tHtml('amostranslation', 'Default language: ') ?>
                <?= (isset($this->context->module->defaultLanguage) ? $this->context->module->defaultLanguage : \Yii::$app->language) ?>
            </strong>
        </p>
    </div>
    <div class="col-md-4">
        <p>
            <strong>         
                <?=
                $model->getAttributeLabel('plugin') .
                $form->field($model, 'plugin')->dropDownList(\yii\helpers\ArrayHelper::map($model->getAllPlugins()->orderBy('plugin')->all(), 'plugin', 'plugin'), ['prompt' => AmosTranslation::t('amostranslation', 'Select ...')])->label(false);
                ?>             
            </strong>
        </p>
    </div>
    <div class="col-md-4">
        <p>
            <strong>           
                <?=
                $model->getAttributeLabel('language_id') .
                $form->field($model, 'language_id')->dropDownList(\yii\helpers\ArrayHelper::map($model->getAllActiveLanguages()->orderBy('name')->all(), 'language_id', 'name'), ['prompt' => AmosTranslation::t('amostranslation', 'Select ...')])->label(false);
                ?>             
            </strong>
        </p>
    </div>


    <div class="col-xs-12">
        <div class="pull-right">            
            <?= Html::submitButton(AmosTranslation::tHtml('amostranslation', 'Filter'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <!--a><p class="text-center">Ricerca avanzata<br>
            < ?=AmosIcons::show('caret-down-circle');?>
        </p></a-->
    <?php
    ActiveForm::end();    
    ?>
</div>