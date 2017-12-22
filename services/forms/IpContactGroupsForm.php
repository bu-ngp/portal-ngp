<?php

namespace ngp\services\forms;

use ngp\services\models\IpContactGroups;
use ngp\services\rules\IpContactGroupRules;
use yii\base\Model;

class IpContactGroupsForm extends Model
{
    public $ip_contact_groups_name;

    public function __construct(IpContactGroups $ipContactGroups = null, $config = [])
    {
        if ($ipContactGroups) {
            $this->ip_contact_groups_name = $ipContactGroups->ip_contact_groups_name;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return IpContactGroupRules::client();
    }

    public function attributeLabels()
    {
        return (new IpContactGroups())->attributeLabels();
    }
}