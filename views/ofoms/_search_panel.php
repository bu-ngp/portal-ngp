<?php

use yii\bootstrap\Html;

/* @var $searchModel \ngp\services\models\search\OfomsSearch */
?>

<div class="form-group pmd-textfield form-group-lg search-ofoms-group">
    <span class="input-group">
        <?= Html::input('text', 'OfomsSearch[search_string]', $searchModel->search_string, ['id' => 'ofoms_search', 'class' => 'form-control input-group-lg', 'placeholder' => Yii::t('ngp/ofoms', 'Enter search string')]) ?>

        <span class="input-group-btn">
        <?= Html::button(Yii::t('ngp/ofoms', 'Rules'), [
            'class' => 'btn btn-lg pmd-btn-outline pmd-ripple-effect btn-primary',
            'data-target' => '#ofoms-rules-dialog',
            'data-toggle' => 'modal',
            'id' => 'ofoms_rules',
        ]) ?>
        </span>


</div><p class="help-block"><?= Yii::t('ngp/ofoms', 'Type to search input and press Enter button') ?></p>