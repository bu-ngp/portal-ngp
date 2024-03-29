<?php

use common\widgets\HeaderPanel\HeaderPanel;
use common\widgets\Html\Html;
use domain\models\base\Person;
use ngp\services\queries\VrachQuery;
use rmrevin\yii\fontawesome\FA;
use common\widgets\ActiveForm\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelForm \ngp\services\forms\OfomsAttachForm */

$this->title = $modelForm->fam . ' ' . $modelForm->im . ' ' . $modelForm->ot;
?>
<div class="ofoms-attach content-container">
    <?= HeaderPanel::widget(['title' => Html::encode($this->title)]) ?>

    <div class="ofoms-attach-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($modelForm, 'enp')->textInput(['wkkeep' => true, 'maxlength' => true, 'disabled' => true]) ?>
        <?= $form->field($modelForm, 'fam')->textInput(['wkkeep' => true, 'maxlength' => true, 'disabled' => true]) ?>
        <?= $form->field($modelForm, 'im')->textInput(['wkkeep' => true, 'maxlength' => true, 'disabled' => true]) ?>
        <?= $form->field($modelForm, 'ot')->textInput(['wkkeep' => true, 'maxlength' => true, 'disabled' => true]) ?>
        <?= $form->field($modelForm, 'dr')->textInput(['wkkeep' => true, 'maxlength' => true, 'disabled' => true]) ?>
        <?= $form->field($modelForm, 'person_id')->select2([
            'activeRecordClass' => Person::className(),
            'activeRecordAttribute' => 'profile_id',
            'exceptAttributesFromResult' => ['profile_id', 'profile_inn'],
            'queryCallback' => VrachQuery::select(),
            'ajaxConfig' => [
                'searchAjaxCallback' => VrachQuery::search(),
            ],
            'wkkeep' => true,
            'wkicon' => FA::_STETHOSCOPE,
            'selectionGridUrl' => ['ofoms/attach-doctor'],
        ]) ?>

        <div class="form-group toolbox-form-group">
            <?= Html::updateButton([], Yii::t('ngp/ofoms', 'Attach')) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>