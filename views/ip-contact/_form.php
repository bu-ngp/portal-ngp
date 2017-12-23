<?php

use ngp\services\models\IpContactGroups;
use ngp\services\queries\IpContactGroupsQuery;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $form \common\widgets\ActiveForm\ActiveForm */
/* @var $modelForm ngp\services\forms\IpContactForm */
?>

<?= $form->field($modelForm, 'ip_contact_name')->textInput(['wkkeep' => true, 'maxlength' => true]) ?>

<?= $form->field($modelForm, 'ip_contact_phone')->textInput(['wkkeep' => true, 'maxlength' => true]) ?>

<?= $form->field($modelForm, 'ip_contact_groups_id')->select2([
    'activeRecordClass' => IpContactGroups::className(),
    'queryCallback' => IpContactGroupsQuery::select(),
    'ajaxConfig' => [
        'searchAjaxCallback' => IpContactGroupsQuery::search(),
    ],
    'wkkeep' => true,
    'wkicon' => FA::_CUBES,
    'selectionGridUrl' => ['ip-contact-groups/index'],
]) ?>