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
            [['ip_contact_name', 'ip_contact_phone'], 'string', 'max' => 255],
        ];
    }
}