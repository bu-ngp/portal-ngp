<?php

use common\widgets\Html\Html;
use common\widgets\ActiveForm\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelForm ngp\services\forms\IpContactForm */

$this->title = Yii::t('ngp/ip-contact', 'Update "{modelClass}": ', [
    'modelClass' => $modelForm->ip_contact_id,
]);
?>
<div class="ip-contact-update content-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="ip-contact-form">

        <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($modelForm, 'ip_contact_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($modelForm, 'ip_contact_phone')->textInput(['maxlength' => true]) ?>

<?= $form->field($modelForm, 'ip_contact_groups_id')->textInput() ?>

        <div class="form-group toolbox-form-group">
            <?= Html::updateButton() ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>