<?php

namespace ngp\controllers;

use ngp\helpers\RbacHelper;
use ngp\services\models\search\IpContactGroupsSearch;
use Yii;
use ngp\services\models\IpContact;
use ngp\services\models\search\IpContactSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\widgets\GridView\services\AjaxResponse;
use ngp\services\forms\IpContactForm;
use domain\services\AjaxFilter;
use ngp\services\services\IpContactService;
use domain\services\ProxyService;
use yii\filters\ContentNegotiator;
use yii\filters\AccessControl;
use yii\web\Response;
use common\widgets\Breadcrumbs\Breadcrumbs;

/**
 * IpContactController implements the CRUD actions for IpContact model.
 */
class IpContactController extends Controller
{
    /**
     * @var $service IpContactService
     */
    private $service;

    public function __construct($id, $module, IpContactService $service, $config = [])
    {
        $this->service = new ProxyService($service);
        parent::__construct($id, $module, $config = []);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'roles' => [RbacHelper::IP_CONTACT_EDIT],
                    ],
                ],
            ],
            [
                'class' => AjaxFilter::className(),
                'actions' => ['delete'],
            ],
            [
                'class' => ContentNegotiator::className(),
                'only' => ['delete'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new IpContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $form = new IpContactForm();

        if ($form->load(Yii::$app->request->post())
            && $form->validate()
            && $this->service->create($form)
        ) {
            Yii::$app->session->setFlash('success', Yii::t('common', 'Record is saved.'));
            return $this->redirect(Breadcrumbs::previousUrl());
        }

        return $this->render('create', [
            'modelForm' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $ipContact = $this->service->find($id);
        $form = new IpContactForm($ipContact);

        if ($form->load(Yii::$app->request->post())
            && $form->validate()
            && $this->service->update($ipContact->primaryKey, $form)
        ) {
            Yii::$app->session->setFlash('success', Yii::t('common', 'Record is saved.'));
            return $this->redirect(Breadcrumbs::previousUrl());
        }

        return $this->render('update', [
            'modelForm' => $form,
        ]);
    }

    public function actionDelete($id)
    {
        try {
            $this->service->delete($id);
        } catch (\Exception $e) {
            return AjaxResponse::init(AjaxResponse::ERROR, $e->getMessage());
        }

        return AjaxResponse::init(AjaxResponse::SUCCESS);
    }
}
