<?php
/**
 * Created by PhpStorm.
 * User: sysadmin
 * Date: 02.11.2017
 * Time: 16:28
 */

namespace ngp\services\rules;


class IpContactGroupRules
{
    public static function client()
    {
        return [
            [['ip_contact_groups_name'], 'required'],
            [['ip_contact_groups_name'], 'string', 'max' => 255],
        ];
    }
}