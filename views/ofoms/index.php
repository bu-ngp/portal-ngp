<?php

use common\widgets\Breadcrumbs\Breadcrumbs;
use common\widgets\HeaderPanel\HeaderPanel;
use common\widgets\Panel\Panel;
use ngp\assets\OfomsAsset;
use ngp\helpers\RbacHelper;
use rmrevin\yii\fontawesome\FA;
use common\widgets\GridView\GridView;
use yii\bootstrap\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel \ngp\services\models\search\OfomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Breadcrumbs::root();
$this->title = Yii::t('ngp/ofoms', 'Ofoms Portal');
?>
    <div class="ofoms-index content-container">
        <?= HeaderPanel::widget(['icon' => FA::_MALE, 'title' => Html::encode($this->title)]) ?>

        <?= Panel::widget([
            'label' => Yii::t('ngp/ofoms', 'Search'),
            'content' => $this->render('_search_panel', ['searchModel' => $searchModel]),
        ]) ?>

        <div class="wk-ofoms-container-results">
            <?= GridView::widget([
                'id' => 'ofomsGrid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'minHeight' => 400,
                'columns' => [
                    [
                        'attribute' => 'ofomsStatus',
                        'format' => 'html',
                    ],
                    'fam',
                    'im',
                    'ot',
                    'dr',
                    'enp',
                    [
                        'attribute' => 'spol',
                        'visible' => false,
                    ],
                    'npol',
                    [
                        'attribute' => 'att_doct_amb',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'ofomsVrach',
                        'noWrap' => false,
                    ],
                    [
                        'attribute' => 'att_lpu_amb',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'att_lpu_stm',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'dt_att_stm',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'w',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'opdoc',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'polis',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'dbeg',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'dend',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'q',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'q_name',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'rstop',
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'ter_st',
                        'noWrap' => false,
                    ],
                ],
                'customActionButtons' => array_merge(
                    Yii::$app->getUser()->can(RbacHelper::OFOMS_PRIK) ? ['prik' => function ($url, $model) {
                        if ($model['dend']) {
                            return '';
                        }

                        return Html::a('<i class="fa fa-2x fa-paperclip"></i>', ['ofoms/attach',
                            'enp' => $model['enp'],
                            'fam' => $model['fam'],
                            'im' => $model['im'],
                            'ot' => $model['ot'],
                            'dr' => $model['dr'],
                            'vrach_inn' => $model['att_doct_amb'],
                        ], [
                            'title' => Yii::t('ngp/ofoms', 'Attach'),
                            'class' => 'btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary wk-ofoms-doc-attach',
                            'data-pjax' => '0'
                        ]);
                    }] : []),
                'customButtons' => array_merge(Yii::$app->getUser()->can(RbacHelper::NGP_OFOMS_PRIK_LIST) ? [
                    '{divider}',
                    Html::a(Yii::t('ngp/ofoms', 'Attach with list'), ['ofoms/attach-list'], ['class' => 'btn btn-xs pmd-btn-flat pmd-ripple-effect btn-success', 'data-pjax' => '0'])
                ] : []),
                'toolbar' => [
                    Html::errorSummary($searchModel, ['class' => 'wk-ofoms-errors']),
                ],
                'panelHeading' => [
                    'title' => Yii::t('ngp/ofoms', 'Results'),
                ],
            ]) ?>

        </div>
    </div>

<?php
Modal::begin([
    'id' => 'ofoms-rules-dialog',
    'size' => Modal::SIZE_LARGE,
    'header' => '<h2 class="pmd-card-title-text">' . Yii::t('ngp/ofoms', 'Ofoms search rules') . '</h2>',
    'footer' => '<button data-dismiss="modal" class="btn pmd-btn-flat pmd-ripple-effect btn-default" type="button">' . Yii::t('ngp/ofoms', 'Close') . '</button>',
    'footerOptions' => [
        'class' => 'pmd-modal-action pmd-modal-bordered text-right',
    ],
]);
echo $this->render('_rules');
Modal::end();

OfomsAsset::register($this) ?>