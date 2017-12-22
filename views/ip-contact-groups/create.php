<?php

use common\widgets\Html\Html;
use common\widgets\ActiveForm\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelForm ngp\services\forms\IpContactGroupsForm */

$this->title = Yii::t('ngp/ip-contact', 'Create Ip Contact Groups');
?>
<div class="ip-contact-groups-create content-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="ip-contact-groups-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($modelForm, 'ip_contact_groups_name')->textInput(['maxlength' => true]) ?>

        <div class="form-group toolbox-form-group">
            <?= Html::createButton() ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>