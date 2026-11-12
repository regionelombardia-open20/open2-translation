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

/**
 *
 * @since 1.0
 */
use yii\grid\GridView;
use yii\helpers\Html;
use lajax\translatemanager\models\Language;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel lajax\translatemanager\models\searches\LanguageSearch */

$this->title = Yii::t('language', 'List of languages');
$this->params['breadcrumbs'][] = $this->title;

?>
<div id="languages">

    <?php
    Pjax::begin([
        'id' => 'languages',
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'language_id',
            'name_ascii',
            [
                'format' => 'raw',
                'filter' => Language::getStatusNames(),
                'attribute' => 'status',
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'status'],
                'label' => Yii::t('language', 'Status'),
                'content' => function ($language) {
                    return Html::activeDropDownList($language, 'status', Language::getStatusNames(), ['class' => 'status', 'id' => $language->language_id, 'data-url' => Yii::$app->urlManager->createUrl('/translatemanager/language/change-status')]);
                },
            ],
            [
                'format' => 'raw',
                'attribute' => Yii::t('language', 'Statistic'),
                'content' => function ($language) {
                    return '<span class="statistic"><span style="width:' . $language->gridStatistic . '%"></span><i>' . $language->gridStatistic . '%</i></span>';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {translate} {delete}',
                'buttons' => [
                    'translate' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', ['language/translate', 'language_id' => $model->language_id], [
                            'title' => Yii::t('language', 'Translate'),
                            'data-pjax' => '0',
                        ]);
                    },
                ],
            ],
        ],
    ]);
    Pjax::end();
    echo Html::a(\open20\amos\translation\AmosTranslation::t('amostranslation', 'Clean cache'), '/translation/translatemanager/clean-cache', [
            'class' => 'btn btn-navigation-primary pull-right'
    ])
    ?>
</div>