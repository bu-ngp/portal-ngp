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

    <h1><?= Html::encode($this->title) ?></h1>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'exportGrid' => [
                'idReportLoader' => 'wk-Report-Loader',
            ],
            'columns' => [
                'ip_contact_name',
            'ip_contact_phone',
            'ip_contact_groups_id',
            ],
            'crudSettings' => [
                'create' => 'ip-contact/create',
                'update' => 'ip-contact/update',
                'delete' => 'ip-contact/delete',
            ],
            'panelHeading' => [
                'icon' => FA::icon(FA::_BARS),
                'title' => Yii::t('ngp/ip-contact', 'Ip Contacts'),
            ],
    ]); ?>

</div>
