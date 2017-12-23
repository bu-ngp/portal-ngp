<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use common\widgets\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel ngp\services\models\search\IpContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ngp/ip-contact', 'Ip Contacts');
?>
<div class="ip-contact-index content-container">

    <h1><?= FA::icon(FA::_PHONE_SQUARE) . Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'exportGrid' => [
            'idReportLoader' => 'wk-Report-Loader',
        ],
        'columns' => [
            'ip_contact_name',
            'ip_contact_phone',
            'ipContactGroups.ip_contact_groups_name',
        ],
        'crudSettings' => [
            'create' => 'ip-contact/create',
            'update' => 'ip-contact/update',
            'delete' => 'ip-contact/delete',
        ],
    ]); ?>

</div>
