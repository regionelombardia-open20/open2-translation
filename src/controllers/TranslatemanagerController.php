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

use open20\amos\core\helpers\BreadcrumbHelper;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use open20\amos\dashboard\controllers\base\DashboardController;
use yii\web\Controller;
use open20\amos\translation\AmosTranslation;

/**
 * Translation controller
 */
class TranslatemanagerController extends Controller {

    public $defaultAction = 'index';
    
    /**
     * @var string $layout Layout for the dashboard
     */
    public $layout = 'main';
    public $dirs = [];

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['clean-cache'],
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
        $this->setAssetDirs();
        // custom initialization code goes here
    }

   public function actionCleanCache(){
        $this->cleanCacheDirs();
        return $this->redirect(BreadcrumbHelper::lastCrumbUrl());
   }

    /**
     * set asset dirs
     */
    public function setAssetDirs()
    {
        array_push($this->dirs, Yii::getAlias('@vendor/../frontend/runtime/cache'));
        array_push($this->dirs, Yii::getAlias('@vendor/../backend/runtime/cache'));
        array_push($this->dirs, Yii::getAlias('@vendor/../console/runtime/cache'));

        array_push($this->dirs, Yii::getAlias('@vendor/../frontend/runtime/translateCache'));
        array_push($this->dirs, Yii::getAlias('@vendor/../backend/runtime/translateCache'));
        array_push($this->dirs, Yii::getAlias('@vendor/../console/runtime/translateCache'));
    }

    /**
     * clean all asset dirs
     */
    public function cleanCacheDirs()
    {
        $nbr_cleaned = 0;

        foreach ($this->dirs as $asset_dir) {
            if (!is_dir($asset_dir)) {
                //echo 'Did not find ' . $asset_dir . '/ .. skipping';
                continue;
            }
            //echo '<p>Checking ' . $asset_dir . '/ to remove old caches .. </p>';

            $nbr_cleaned += self::cleanCacheDir($asset_dir);
        }
        \Yii::$app->getSession()->addFlash('success',
                    AmosTranslation::t('amostranslation', '#cache_deleted'));
        //echo '<p>Finished</p>';

        return $nbr_cleaned;
    }



    /**
     * clean asset dir
     * may remove subdirs in asset dir
     *
     * @param string $asset_dir
     * @return int
     */
    public function cleanCacheDir($asset_dir)
    {

        $now = time();
        $asset_temp_dirs = glob($asset_dir . '/*', GLOB_ONLYDIR);

        // check if less than want to keep
        if (!count($asset_temp_dirs)) {
            return 0;
        }

        // get all dirs and sort by modified
        $modified = [];
        foreach ($asset_temp_dirs as $asset_temp_dir) {
            $modified[$asset_temp_dir] = filemtime($asset_temp_dir);
        }

        asort($modified);
        $nbr_dirs = count($modified);

        // keep last dirs
        for ($i = min($nbr_dirs, 0); $i > 0; $i--) {
            array_pop($modified);
        }

        // remove dirs
        foreach ($modified as $dir => $mod) {
            //echo '<p>' . 'removed ' . $dir . '</p>';
            FileHelper::removeDirectory($dir);
        }

        return $nbr_dirs;
    }

}
