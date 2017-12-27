<?php
/**
 * Created by PhpStorm.
 * User: sysadmin
 * Date: 09.11.2017
 * Time: 11:50
 */

namespace ngp\services\services;

use doh\services\classes\DoH;
use domain\helpers\BinaryHelper;
use domain\models\base\Profile;
use domain\repositories\base\ProfileRepository;
use domain\services\Service;
use ngp\services\forms\OfomsAttachForm;
use ngp\services\forms\OfomsAttachListForm;
use ngp\services\proccesses\OfomsAttachListProccessLoader;
use ngp\services\repositories\OfomsRepository;
use wartron\yii2uuid\helpers\Uuid;
use Yii;

class OfomsService extends Service
{
    private $ofoms;
    private $profiles;

    public function __construct(
        OfomsRepository $ofoms,
        ProfileRepository $profiles
    )
    {
        $this->ofoms = $ofoms;
        $this->profiles = $profiles;
    }

    public function search($searchString)
    {
        return $this->ofoms->search($searchString);
    }

    public function attach(OfomsAttachForm $form)
    {
        $profile = $this->getProfile($form->person_id);
        if (!$profile) {
            throw new \DomainException(Yii::t('ngp/ofoms', 'Profile doctor not found.'));
        }

        if ($this->vrachChanged($profile->profile_inn)) {
            $result = $this->ofoms->attach($form->ffio, $form->enp, $profile->profile_inn);

            if ($result['status'] < 1) {
                throw new \DomainException($result['message']);
            }
        }
    }

    public function attachList(OfomsAttachListForm $form)
    {
        $doh = new DoH(new OfomsAttachListProccessLoader($form));
        $doh->execute();
    }

    protected function vrachChanged($selectedVrachINN)
    {
        return Yii::$app->request->get('vrach_inn') !== $selectedVrachINN;
    }

    protected function getProfile($id)
    {
        $uuid = Uuid::str2uuid($id);
        return $this->profiles->has($uuid) ? $this->profiles->find($uuid) : false;
    }
}