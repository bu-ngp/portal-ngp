<?php

use common\widgets\HeaderPanel\HeaderPanel;
use ngp\helpers\RbacHelper;
use yii\db\ActiveQuery;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use common\widgets\GridView\GridView;

/* @var $this yii\web\View */
/* @var $searchModel ngp\services\models\search\IpContactGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ngp/ip-contact', 'Ip Contact Groups');
?>
<div class="ip-contact-groups-index content-container">
    <?= HeaderPanel::widget(['icon' => FA::_CUBES, 'title' => Html::encode($this->title)]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'exportGrid' => [
            'idReportLoader' => 'wk-Report-Loader',
        ],
        'columns' => [
            'ip_contact_groups_name',
        ],
        'crudSettings' => [
            'create' => [
                'url' => 'ip-contact-groups/create',
                'beforeRender' => function () {
                    return Yii::$app->user->can(RbacHelper::IP_CONTACT_EDIT);
                },
            ],
            'update' => [
                'url' => 'ip-contact-groups/update',
                'beforeRender' => function () {
                    return Yii::$app->user->can(RbacHelper::IP_CONTACT_EDIT);
                },
            ],
            'delete' => [
                'url' => 'ip-contact-groups/delete',
                'beforeRender' => function () {
                    return Yii::$app->user->can(RbacHelper::IP_CONTACT_EDIT);
                },
            ],
        ],
        'gridExcludeIdsFunc' => function (ActiveQuery $activeQuery, array $ids) {
            $activeQuery->andWhere(['not in', 'ip_contact_groups_id', $ids]);
        },
    ]); ?>

</div>
