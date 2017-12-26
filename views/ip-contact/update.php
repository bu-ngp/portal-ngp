<?php

use common\widgets\HeaderPanel\HeaderPanel;
use common\widgets\Html\Html;
use common\widgets\ActiveForm\ActiveForm;
use common\widgets\Panel\Panel;
use ngp\services\models\IpContactGroups;
use ngp\services\queries\IpContactGroupsQuery;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $modelForm ngp\services\forms\IpContactForm */

$this->title = Yii::t('ngp/ip-contact', 'Update Ip Contact');
?>
<div class="ip-contact-update content-container">
    <?= HeaderPanel::widget(['icon' => FA::_PHONE_SQUARE, 'title' => Html::encode($this->title)]) ?>

    <div class="ip-contact-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= Panel::widget([
            'label' => '',
            'content' => $this->render('_form', ['form' => $form, 'modelForm' => $modelForm]),
        ]) ?>

        <div class="form-group toolbox-form-group">
            <?= Html::updateButton() ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>