<?php

use common\widgets\HeaderPanel\HeaderPanel;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use common\widgets\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel ngp\services\models\search\IpContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ngp/ip-contact', 'Ip Contacts');
?>
<div class="ip-contact-index content-container">
    <?= HeaderPanel::widget(['icon' => FA::_PHONE_SQUARE, 'title' => Html::encode($this->title)]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'exportGrid' => [
            'idReportLoader' => 'wk-Report-Loader',
        ],
        'columns' => [
            'ip_contact_name',
            [
                'attribute' => 'ip_contact_phone',
                'value' => function ($model) {
                    return preg_match('/\d(\d{4})(\d{2})(\d{2})(\d{2})/', $model->ip_contact_phone, $matches)
                        ? "8-({$matches[1]})-{$matches[2]}-{$matches[3]}-{$matches[4]}"
                        : $model->ip_contact_phone;
                }
            ],
            [
                'attribute' => 'ip_contact_phone2',
                'value' => function ($model) {
                    return preg_match('/\d(\d{4})(\d{2})(\d{2})(\d{2})/', $model->ip_contact_phone2, $matches)
                        ? "8-({$matches[1]})-{$matches[2]}-{$matches[3]}-{$matches[4]}"
                        : $model->ip_contact_phone2;
                }
            ],
            [
                'attribute' => 'ip_contact_phone3',
                'value' => function ($model) {
                    return preg_match('/\d(\d{4})(\d{2})(\d{2})(\d{2})/', $model->ip_contact_phone3, $matches)
                        ? "8-({$matches[1]})-{$matches[2]}-{$matches[3]}-{$matches[4]}"
                        : $model->ip_contact_phone3;
                }
            ],
            'ipContactGroups.ip_contact_groups_name',
        ],
        'crudSettings' => [
            'create' => 'ip-contact/create',
            'update' => 'ip-contact/update',
            'delete' => 'ip-contact/delete',
        ],
    ]); ?>

</div>
