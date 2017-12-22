<?php

namespace ngp\services\forms;

use ngp\services\models\IpContact;
use ngp\services\rules\IpContactRules;
use yii\base\Model;

class IpContactForm extends Model
{
    public $ip_contact_name;
    public $ip_contact_phone;
    public $ip_contact_groups_id;

    public function __construct(IpContact $ipContact = null, $config = [])
    {
        if ($ipContact) {
            $this->ip_contact_name = $ipContact->ip_contact_name;
            $this->ip_contact_phone = $ipContact->ip_contact_phone;
            $this->ip_contact_groups_id = $ipContact->ip_contact_groups_id;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return IpContactRules::client();
    }

    public function attributeLabels()
    {
        return (new IpContact())->attributeLabels();
    }
}