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
            [['ip_contact_name'], 'string', 'max' => 25],
            [['ip_contact_phone'], 'filter', 'filter' => function ($value) {
                return preg_replace('/[-\(\)_]/', '', $value);
            }],
            [['ip_contact_phone'], 'string', 'min' => 11, 'max' => 11],
            [['ip_contact_phone'], 'match', 'pattern' => '/^\d{11}$/'],
        ];
    }
}