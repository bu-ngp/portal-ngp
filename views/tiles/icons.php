<?php
/**
 * Created by PhpStorm.
 * User: sysadmin
 * Date: 13.11.2017
 * Time: 15:12
 */


use common\widgets\HeaderPanel\HeaderPanel;
use ngp\assets\TilesAsset;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $icons array */
/* @var $redirectTo string */

$this->title = Yii::t('ngp/tiles', 'Choose Icon');
?>
    <div class="tiles-icons content-container">
        <?= HeaderPanel::widget(['title' => Html::encode($this->title)]) ?>

        <div class="row">
            <div class="col-md-12 wk-tiles-icons">
                <?php
                foreach ($icons as $icon) {
                    echo '<div class="col-md-1"><a href="' . Url::to(['tiles/' . $redirectTo, 'icon' => $icon, 'id' => Yii::$app->request->get('id', '')]) . '">' . FA::icon($icon) . '</a></div>';
                }
                ?>
            </div>
        </div>
    </div>

<?php TilesAsset::register($this) ?>