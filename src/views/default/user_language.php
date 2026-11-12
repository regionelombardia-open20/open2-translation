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
use open20\amos\core\views\DataProviderView;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
use open20\amos\translation\AmosTranslation;
use open20\amos\translation\models\TranslationConf;
use open20\amos\core\icons\AmosIcons;
use open20\amos\core\forms\ActiveForm;
use open20\amos\core\forms\CloseSaveButtonWidget;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = AmosTranslation::t('amostranslation', 'Manage allowed translation of the user');
$this->params['breadcrumbs'][] = ['label' => AmosTranslation::t('amostranslation', 'Translate manager'), 'url' => ['/translation']];
$this->params['breadcrumbs'][] = ['label' => AmosTranslation::t('amostranslation', 'Manage translators'), 'url' => ['/translation/default/translators']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professional-profiles-index"> 
    <?php //echo $this->render('_filter', ['model' => $model]); ?>

    <p>
        <?php /* echo         Html::a('Nuovo Professional Profiles'        , ['create'], ['class' => 'btn btn-amministration-primary']) */ ?>
    </p>

    <?php
    $form = ActiveForm::begin();
    ?>
    <div class="row">
        <div class="col-lg-6">
            <h2>User:</h2>
            <h3><?= $userProfile->one()->nome . ' ' . $userProfile->one()->cognome ?></h3>            
        </div>
        <div class="col-lg-6">
            <?php
            $lngs = TranslationConf::getStaticAllActiveLanguages()
                    ->orderBy('language_id');
            
            echo $form->field($model, 'language')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(
                                    $lngs->all(), 'language_id', 'name'), ['prompt' => AmosTranslation::t('amostranslation', 'Select allowed languages ...'), 'multiple' => true, 'size' => ($lngs->count() > 3) ? $lngs->count() + 1 : 3]
                    )->label('Allowed languages');
            ?>
        </div>    
    </div>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php
    ActiveForm::end();
    ?>
</div>
