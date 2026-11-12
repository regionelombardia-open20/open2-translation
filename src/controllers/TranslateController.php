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

namespace open20\amos\translation\controllers;

use open20\amos\translation\AmosTranslation;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use open20\amos\dashboard\controllers\base\DashboardController;

/**
 * Translation controller
 */
class TranslateController extends DashboardController {

    public $defaultAction = 'index';
    
    /**
     * @var string $layout Layout for the dashboard
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['language', 'error', 'contents', 'records', 'update', 'index', 'translators', 'user-language', 'force-regenerate-tables-and-models'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function init() {

        parent::init();
        $this->setUpLayout();
        // custom initialization code goes here
    }

    public function actionIndex()
    {
        $this->setUpLayout('dashboard_interna');
        Url::remember();
       
        return $this->render('index');
    }


    /**
     * @param null $layout
     * @return bool
     */
    public function setUpLayout($layout = null)
    {
        if ($layout === false) {
            $this->layout = false;
            return true;
        }
        $this->layout = (!empty($layout)) ? $layout : $this->layout;
        $module = \Yii::$app->getModule('layout');
        if (empty($module)) {
            if (strpos($this->layout, '@') === false) {
                $this->layout = '@vendor/open20/amos-core/views/layouts/'.(!empty($layout) ? $layout : $this->layout);
            }
            return true;
        }
        return true;
    }

    /**
     * @return \yii\web\Response
     */
    public function actionForceRegenerateTablesAndModels(){
        /** @var  $module AmosTranslation */
        $module = \Yii::$app->getModule('translation');
        if($module){
            $module->generateTranslationTables(true, true);
            $module->generateTranslationModels(true);

        }
        \Yii::$app->session->addFlash('success', "Tabelle rigenerate correttamente");
        return $this->redirect('/');
    }
}
