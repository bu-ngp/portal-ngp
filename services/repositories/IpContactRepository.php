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
}