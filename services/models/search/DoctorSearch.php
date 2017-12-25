<?php

namespace ngp\services\models\search;

use domain\models\base\Person;
use domain\services\SearchModel;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class DoctorSearch extends SearchModel
{
    public static function activeRecord()
    {
        return new Person;
    }

    public function attributes()
    {
        return [
            'person_id',
            'profile.profile_inn',
            'person_fullname',
            'employee.dolzh.dolzh_name',
            'employee.podraz.podraz_name',
        ];
    }

    public function defaultSortOrder()
    {
        return ['person_fullname' => SORT_ASC];
    }

    public function beforeLoad(ActiveQuery $query, ActiveDataProvider $dataProvider, $params)
    {
        $query->joinWith([
            'profile',
            'employee.dolzh',
            'employee.podraz',
        ])->andWhere([
            'or',
            ['like', 'dolzh.dolzh_name', 'ВРАЧ ОБЩЕЙ ПРАКТИКИ'],
            ['like', 'dolzh.dolzh_name', 'ТЕРАПЕВТ УЧАСТКОВЫЙ'],
        ])->andWhere(['person_fired' => null]);
    }

    public function filter()
    {
        return [
            [['person_fullname', 'employee.dolzh.dolzh_name', 'employee.podraz.podraz_name'], SearchModel::CONTAIN],
        ];
    }
}
