<?php
/**
 * Created by PhpStorm.
 * User: sysadmin
 * Date: 22.12.2017
 * Time: 16:48
 */

namespace ngp\services\rules;


class IpContactRules
{
    public static function client()
    {
        return [
            [['ip_contact_name', 'ip_contact_phone', 'ip_contact_groups_id'], 'required'],
            [['ip_contact_groups_id'], 'integer'],
            [['ip_contact_name'], 'string', 'max' => 30],
            [['ip_contact_phone', 'ip_contact_phone2', 'ip_contact_phone3'], 'filter', 'filter' => function ($value) {
                return preg_replace('/[-\(\)_]/', '', $value);
            }],
            [['ip_contact_phone', 'ip_contact_phone2', 'ip_contact_phone3'], 'string', 'min' => 11, 'max' => 11],
            [['ip_contact_phone', 'ip_contact_phone2', 'ip_contact_phone3'], 'match', 'pattern' => '/^\d{11}$/'],
        ];
    }
}