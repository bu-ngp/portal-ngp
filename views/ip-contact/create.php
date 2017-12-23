<?php

use common\widgets\Html\Html;
use common\widgets\ActiveForm\ActiveForm;
use common\widgets\Panel\Panel;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $modelForm ngp\services\forms\IpContactForm */

$this->title = Yii::t('ngp/ip-contact', 'Create Ip Contact');
?>
<div class="ip-contact-create content-container">

    <h1><?= FA::icon(FA::_PHONE_SQUARE) . Html::encode($this->title) ?></h1>

    <div class="ip-contact-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= Panel::widget([
            'label' => '',
            'content' => $this->render('_form', ['form' => $form, 'modelForm' => $modelForm]),
        ]) ?>

        <div class="form-group toolbox-form-group">
            <?= Html::createButton() ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>