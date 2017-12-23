<?php

namespace ngp\controllers;

use ngp\helpers\RbacHelper;
use ngp\services\models\IpContactGroups;
use ngp\services\models\search\IpContactGroupsSearch;
use ngp\services\services\IpContactGroupsService;
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
use yii\web\XmlResponseFormatter;

/**
 * IpContactController implements the CRUD actions for IpContact model.
 */
class IpContactController extends Controller
{
    /**
     * @var $ipContactService IpContactService
     */
    private $ipContactService;
    /**
     * @var $contactGroupsService IpContactGroupsService
     */
    private $contactGroupsService;

    public function __construct($id, $module, IpContactService $ipContactService, IpContactGroupsService $contactGroupsService, $config = [])
    {
        $this->ipContactService = new ProxyService($ipContactService);
        $this->contactGroupsService = new ProxyService($contactGroupsService);

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
                    [
                        'allow' => true,
                        'actions' => ['menu', 'contact'],
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
            [
                'class' => ContentNegotiator::className(),
                'only' => ['menu'],
                'formats' => [
                    'application/xml' => Response::FORMAT_XML,
                ],

            ],
            [
                'class' => ContentNegotiator::className(),
                'only' => ['contact'],
                'formats' => [
                    'application/xml' => Response::FORMAT_XML,
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
            && $this->ipContactService->create($form)
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
        $ipContact = $this->ipContactService->find($id);
        $form = new IpContactForm($ipContact);

        if ($form->load(Yii::$app->request->post())
            && $form->validate()
            && $this->ipContactService->update($ipContact->primaryKey, $form)
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
            $this->ipContactService->delete($id);
        } catch (\Exception $e) {
            return AjaxResponse::init(AjaxResponse::ERROR, $e->getMessage());
        }

        return AjaxResponse::init(AjaxResponse::SUCCESS);
    }

    public function actionMenu()
    {
        Yii::$app->response->formatters[Response::FORMAT_XML] = [
            'class' => 'yii\web\XmlResponseFormatter',
            'rootTag' => 'YealinkIPPhoneMenu',
            'itemTag' => 'MenuItem',
        ];

        return $this->contactGroupsService->menu();
    }

    public function actionContact($id)
    {
        Yii::$app->response->formatters[Response::FORMAT_XML] = [
            'class' => 'yii\web\XmlResponseFormatter',
            'rootTag' => 'YealinkIPPhoneDirectory',
            'itemTag' => 'DirectoryEntry',
        ];

        return $this->ipContactService->contact($id);
    }
}
