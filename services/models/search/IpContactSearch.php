<?php

namespace ngp\services\models\search;

use ngp\services\models\IpContact;
use domain\services\SearchModel;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class IpContactSearch extends SearchModel
{
    public static function activeRecord()
    {
        return new IpContact;
    }

    public function attributes()
    {
        return [
            'ip_contact_name',
            'ip_contact_phone',
            'ip_contact_phone2',
            'ip_contact_phone3',
            'ipContactGroups.ip_contact_groups_name',
        ];
    }

    public function defaultSortOrder()
    {
        return ['ip_contact_name' => SORT_ASC];
    }

    public function beforeLoad(ActiveQuery $query, ActiveDataProvider $dataProvider, $params)
    {
        $query->joinWith([
            'ipContactGroups',
        ]);
    }

    public function filter()
    {
        return [
            [['ip_contact_name', 'ip_contact_phone', 'ip_contact_phone2', 'ip_contact_phone3', 'ipContactGroups.ip_contact_groups_name'], SearchModel::CONTAIN],
        ];
    }
}
