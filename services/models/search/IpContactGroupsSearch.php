<?php

namespace ngp\services\models\search;

use domain\services\SearchModel;
use ngp\services\models\IpContactGroups;

class IpContactGroupsSearch extends SearchModel
{
    public static function activeRecord()
    {
        return new IpContactGroups;
    }

    public function attributes()
    {
        return [
            'ip_contact_groups_name',
        ];
    }

    public function defaultSortOrder()
    {
        return ['ip_contact_groups_name' => SORT_ASC];
    }

    public function filter()
    {
        return [
            ['ip_contact_groups_name', SearchModel::CONTAIN],
        ];
    }
}
