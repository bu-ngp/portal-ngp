<?php

namespace ngp\services\repositories;

use ngp\services\models\IpContact;
use domain\exceptions\ServiceErrorsException;
use RuntimeException;
use Yii;

class IpContactRepository
{
    /**
     * @param $id
     * @return IpContact
     */
    public function find($id)
    {
        if (!$ipContact = IpContact::findOne($id)) {
            throw new RuntimeException('Model not found.');
        }

        return $ipContact;
    }

    /**
     * @param IpContact $ipContact
     */
    public function add($ipContact)
    {
        if (!$ipContact->getIsNewRecord()) {
            throw new \DomainException(Yii::t('domain/base', 'Adding existing model.'));
        }
        if (!$ipContact->insert(false)) {
            throw new \DomainException(Yii::t('domain/base', 'Saving error.'));
        }
    }

    /**
     * @param IpContact $ipContact
     */
    public function save($ipContact)
    {
        if ($ipContact->getIsNewRecord()) {
            throw new \DomainException(Yii::t('domain/base', 'Adding existing model.'));
        }
        if ($ipContact->update(false) === false) {
            throw new \DomainException(Yii::t('domain/base', 'Saving error.'));
        }
    }

    /**
     * @param IpContact $ipContact
     */
    public function delete($ipContact)
    {
        if (!$ipContact->delete()) {
            throw new \DomainException(Yii::t('domain/base', 'Deleting error.'));
        }
    }

    public function contact($id)
    {
        $contacts = IpContact::find()
            ->select(['ip_contact_name as Name', 'ip_contact_phone', 'ip_contact_phone2', 'ip_contact_phone3'])
            ->andWhere(['ip_contact_groups_id' => $id])
            ->asArray()
            ->all();

        return array_map(function ($contact) {
            foreach (['ip_contact_phone', 'ip_contact_phone2', 'ip_contact_phone3'] as $attribute) {
                if (isset($contact[$attribute])) {
                    array_push($contact, (object)['Telephone' => $contact[$attribute]]);
                    unset($contact[$attribute]);
                }
            }

            return $contact;
        }, $contacts);
    }
}