<?php

use common\widgets\Html\Html;
use common\widgets\ActiveForm\ActiveForm;
use ngp\services\models\IpContactGroups;
use ngp\services\queries\IpContactGroupsQuery;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $modelForm ngp\services\forms\IpContactForm */

$this->title = Yii::t('ngp/ip-contact', 'Create Ip Contact');
?>
<div class="ip-contact-create content-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="ip-contact-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($modelForm, 'ip_contact_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelForm, 'ip_contact_phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelForm, 'ip_contact_groups_id')->select2([
            'activeRecordClass' => IpContactGroups::className(),
            'queryCallback' => IpContactGroupsQuery::select(),
            'ajaxConfig' => [
                'searchAjaxCallback' => IpContactGroupsQuery::search(),
            ],
            'wkkeep' => true,
            'wkicon' => FA::_PUZZLE_PIECE,
            'selectionGridUrl' => ['ip-contact-groups/index'],
        ]) ?>

        <div class="form-group toolbox-form-group">
            <?= Html::createButton() ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>