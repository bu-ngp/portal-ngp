<?php

namespace ngp\services\models;

use Yii;
use ngp\services\forms\IpContactForm;

/**
 * This is the model class for table "wk_ip_contact".
 *
 * @property integer $ip_contact_id
 * @property string $ip_contact_name
 * @property string $ip_contact_phone
 * @property integer $ip_contact_groups_id
 *
 * @property IpContactGroups $ipContactGroups
 */
class IpContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wk_ip_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip_contact_name', 'ip_contact_phone', 'ip_contact_groups_id'], 'required'],
            [['ip_contact_groups_id'], 'integer'],
            [['ip_contact_name', 'ip_contact_phone'], 'string', 'max' => 255],
            [['ip_contact_name', 'ip_contact_phone'], 'unique', 'targetAttribute' => ['ip_contact_name', 'ip_contact_phone'], 'message' => 'The combination of Ip Contact Name and Ip Contact Phone has already been taken.'],
            [['ip_contact_groups_id'], 'exist', 'skipOnError' => true, 'targetClass' => IpContactGroups::className(), 'targetAttribute' => ['ip_contact_groups_id' => 'ip_contact_groups_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ip_contact_id' => Yii::t('ngp/ip-contact', 'Ip Contact ID'),
            'ip_contact_name' => Yii::t('ngp/ip-contact', 'Ip Contact Name'),
            'ip_contact_phone' => Yii::t('ngp/ip-contact', 'Ip Contact Phone'),
            'ip_contact_groups_id' => Yii::t('ngp/ip-contact', 'Ip Contact Groups ID'),
        ];
    }

    public static function create(IpContactForm $form)
    {
        return new self([
            'ip_contact_name' => $form->ip_contact_name,
            'ip_contact_phone' => $form->ip_contact_phone,
            'ip_contact_groups_id' => $form->ip_contact_groups_id,
        ]);
    }

    public function edit(IpContactForm $form)
    {
        $this->ip_contact_name = $form->ip_contact_name;
        $this->ip_contact_phone = $form->ip_contact_phone;
        $this->ip_contact_groups_id = $form->ip_contact_groups_id;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIpContactGroups()
    {
        return $this->hasOne(IpContactGroups::className(), ['ip_contact_groups_id' => 'ip_contact_groups_id'])->from(['ipContactGroups' => IpContactGroups::tableName()]);
    }
}