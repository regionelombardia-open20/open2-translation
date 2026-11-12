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

use yii\bootstrap\Progress;
use open20\amos\core\helpers\Html;
use yii\helpers\StringHelper;
use open20\amos\translation\models\TranslationUserLanguageMm;
?>
<?php
if (strpos(\yii\helpers\Url::current(), 'create') === false) {
    ?>
    <div class="container-language m-t-10">
        <?php
        $ind = 1;
        foreach ($statusLangs as $key => $value) {
            ?>
            <div class="col-lg-2 col-md-3 col-xs-6">
                <?php
                $url = "/translation/default/update?id={$getParams['id']}&lang=$key&namespace=$namespace";
                $can = true;
                $module = \Yii::$app->getModule('translation');
                $newModel = $module->modelNs . "\\" . StringHelper::basename($namespace) . "Translation";
                $can = (\Yii::$app->getUser()->can('TRANSLATOR', ['model' => new TranslationUserLanguageMm(), 'language' => $key]) && ((!empty($module->defaultLanguage) && $key != $module->defaultLanguage) || (!isset($module->defaultLanguage))));
                $defLang = $module->defaultLanguage;
                if (!empty($defLang) && $defLang == $key) {
                    $can = false;
                }
                ?>
                <p>
                    <?php if ($can): ?>                
                        <a href="/translation/default/update?id=<?= $getParams['id'] ?>&lang=<?= $key ?>&namespace=<?= $namespace ?>" title="Go to translation in <?= $key ?>" target="_blank">
                            <?= $key ?>                                
                        </a>
                    <?php else: ?>
                        <a href="/translation/default/view-tr?id=<?= $getParams['id'] ?>&lang=<?= $key ?>&namespace=<?= $namespace ?>" title="Go to translation in <?= $key ?>" target="_blank">
                            <?= $key ?>                                
                        </a>
                    <?php endif; ?>
                    <?= $value ?>
                </p>

            </div>    
            <?php
            if ((($ind) % 6) == 0 && $ind > 2) {
                ?>
                <hr class="container-language">
                <?php
            }
            $ind++;
        }
        if (($ind - 1 ) % 6 == 0) {
            ?>
            <hr class="container-language">
            <?php
        } else {
            ?>
            <hr class="container-language">
            <?php
        }
        ?>
    </div>
<?php } ?>
