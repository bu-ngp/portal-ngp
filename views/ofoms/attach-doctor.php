<?php

use common\widgets\HeaderPanel\HeaderPanel;
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
    <?= HeaderPanel::widget(['icon' => FA::_STETHOSCOPE, 'title' => Html::encode($this->title)]) ?>

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
            $activeQuery->andWhere(['not in', 'profile.profile_inn', $ids]);
        }
    ]);
    ?>
</div>