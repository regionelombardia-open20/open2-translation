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

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = AmosTranslation::t('amostranslation', 'Manage translators');
$this->params['breadcrumbs'][] = ['label' => AmosTranslation::t('amostranslation', 'Translate manager'), 'url' => ['/translation']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professional-profiles-index"> 
    <?php //echo $this->render('_filter', ['model' => $model]); ?>

    <p>
        <?php /* echo         Html::a('Nuovo Professional Profiles'        , ['create'], ['class' => 'btn btn-amministration-primary']) */ ?>
    </p>

    <?php     
    echo open20\amos\core\views\AmosGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'nome', 
            'cognome',
            'codice_fiscale',            
            [
                'attribute' => 'languages',
                'label' => AmosTranslation::t('amostranslation', 'Languages'),
                'format' => 'html',
                'value' => function ($model){
                    $languages = open20\amos\translation\models\TranslationUserLanguageMm::find()->andWhere(['user_id' => $model['user_id']]);
                    if($languages->count()){
                        $i = 0;
                        $lng = '';
                        foreach ($languages->all() as $l){
                        $lng .= ($i == 0? '' : '<br>') . $l->language;
                        $i++;
                        }                        
                        return $lng;
                    } else {
                        return AmosTranslation::t('amostranslation', 'Not set');
                    }
                },             
            ],           
               [
            'class' => \open20\amos\core\views\grid\ActionColumn::className(),
            'template' => '{custom}',
            'buttons' => [
                'custom' => function ($url, $model) {                      
                    $url = yii\helpers\Url::current();                    
                    $urlDestination = \Yii::$app->urlManager->createUrl(['/translation/default/user-language', 'user_id' => $model['user_id'] , 'url' => $url]);
                    return \yii\helpers\Html::a(AmosIcons::show('square-right', ['class' => 'btn btn-tool-secondary']), $urlDestination, [
                        'title' => AmosTranslation::t('app', 'Choose the language he can translate'),                        
                    ]);
                },

            ]
        ]
        ],
    ]);
    ?>

</div>
