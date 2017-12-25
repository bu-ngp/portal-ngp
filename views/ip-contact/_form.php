<?php

use ngp\services\models\IpContactGroups;
use ngp\services\queries\IpContactGroupsQuery;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $form \common\widgets\ActiveForm\ActiveForm */
/* @var $modelForm ngp\services\forms\IpContactForm */
?>


    <div class="form-group">
        <div class="row">
            <div class="col-xs-6">
                <?= $form->field($modelForm, 'ip_contact_name')->textInput(['wkkeep' => true, 'maxlength' => true, 'wkicon' => FA::_GROUP])->hint(Yii::t('ngp/ip-contact','No more 25 characters')) ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($modelForm, 'ip_contact_phone', ['enableClientValidation' => false])->maskedInput(['wkkeep' => true, 'mask' => '8-(9999)-99-99-99', 'wkicon' => FA::_PHONE]) ?>
            </div>
        </div>
    </div>

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