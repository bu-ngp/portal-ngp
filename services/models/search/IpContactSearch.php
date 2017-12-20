<?php

namespace ngp\services\models\search;

use ngp\services\models\IpContact;
use domain\services\SearchModel;

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
            'ip_contact_groups_id',
        ];
    }

    public function defaultSortOrder()
    {
        return ['ip_contact_name' => SORT_ASC];
    }

    public function filter()
    {
        return [

        ];
    }
}
