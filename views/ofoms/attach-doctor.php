<?php

use domain\models\base\Person;
use common\widgets\GridView\GridView;
use console\helpers\RbacHelper;
use rmrevin\yii\fontawesome\FA;
use yii\db\ActiveQuery;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel domain\models\base\search\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ngp/ofoms', 'Doctors');
?>
<div class="users-index content-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'exportGrid' => [
            'idReportLoader' => 'wk-Report-Loader',
        ],
        'columns' => [
            'person_fullname',
            [
                'attribute' => 'employee.podraz.podraz_name',
                'label' => Yii::t('domain/employee', 'Podraz ID'),
            ],
            [
                'attribute' => 'employee.dolzh.dolzh_name',
                'label' => Yii::t('domain/employee', 'Dolzh ID'),
            ],
        ],
        'gridExcludeIdsFunc' => function (ActiveQuery $activeQuery, array $ids) {
            $activeQuery->andWhere(['not in', '{{%person}}.person_id', $ids]);
        }
    ]);
    ?>
</div>