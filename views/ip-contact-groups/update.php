<?php

use common\widgets\HeaderPanel\HeaderPanel;
use common\widgets\Html\Html;
use common\widgets\ActiveForm\ActiveForm;
use common\widgets\Panel\Panel;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $modelForm ngp\services\forms\IpContactGroupsForm */

$this->title = Yii::t('ngp/ip-contact', 'Update Ip Contact Group');
?>
<div class="ip-contact-groups-update content-container">
    <?= HeaderPanel::widget(['icon' => FA::_CUBES, 'title' => Html::encode($this->title)]) ?>

    <div class="ip-contact-groups-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= Panel::widget([
            'label' => '',
            'content' => $form->field($modelForm, 'ip_contact_groups_name')->textInput(['wkkeep' => true, 'maxlength' => true]),
        ]) ?>

        <div class="form-group toolbox-form-group">
            <?= Html::updateButton() ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>