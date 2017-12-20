<?php

namespace ngp\services\repositories;

use ngp\services\models\IpContactGroups;
use domain\exceptions\ServiceErrorsException;
use RuntimeException;
use Yii;

class IpContactGroupsRepository
{
    /**
     * @param $id
     * @return IpContactGroups
     */
    public function find($id)
    {
        if (!$ipContactGroups = IpContactGroups::findOne($id)) {
            throw new RuntimeException('Model not found.');
        }

        return $ipContactGroups;
    }

    /**
     * @param IpContactGroups $ipContactGroups
     */
    public function add($ipContactGroups)
    {
        if (!$ipContactGroups->getIsNewRecord()) {
            throw new \DomainException(Yii::t('domain/base', 'Adding existing model.'));
        }
        if (!$ipContactGroups->insert(false)) {
            throw new \DomainException(Yii::t('domain/base', 'Saving error.'));
        }
    }

    /**
     * @param IpContactGroups $ipContactGroups
     */
    public function save($ipContactGroups)
    {
        if ($ipContactGroups->getIsNewRecord()) {
            throw new \DomainException(Yii::t('domain/base', 'Adding existing model.'));
        }
        if ($ipContactGroups->update(false) === false) {
            throw new \DomainException(Yii::t('domain/base', 'Saving error.'));
        }
    }

    /**
     * @param IpContactGroups $ipContactGroups
     */
    public function delete($ipContactGroups)
    {
        if (!$ipContactGroups->delete()) {
            throw new \DomainException(Yii::t('domain/base', 'Deleting error.'));
        }
    }
}