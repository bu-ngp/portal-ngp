<?php
/**
 * Created by PhpStorm.
 * User: sysadmin
 * Date: 10.10.2017
 * Time: 8:21
 */

namespace ngp\services\queries;


use yii\db\ActiveQuery;

class IpContactGroupsQuery
{
    public static function select()
    {
        return function (ActiveQuery $query) {
            return $query->select(['ip_contact_groups_id', 'ip_contact_groups_name']);
        };
    }

    public static function search()
    {
        return function (ActiveQuery $query, $searchString) {
            $query->andWhere(['like', 'ip_contact_groups_name', $searchString]);
        };
    }
}