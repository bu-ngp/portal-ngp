<?php

namespace ngp\services\models;

use Yii;
use ngp\services\forms\IpContactGroupsForm;

/**
 * This is the model class for table "wk_ip_contact_groups".
 *
 * @property integer $ip_contact_groups_id
 * @property string $ip_contact_groups_name
 *
 * @property IpContact[] $ipContacts
 */
class IpContactGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wk_ip_contact_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip_contact_groups_name'], 'required'],
            [['ip_contact_groups_name'], 'string', 'max' => 255],
            [['ip_contact_groups_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ip_contact_groups_id' => Yii::t('ngp/ip-contact', 'Ip Contact Groups ID'),
            'ip_contact_groups_name' => Yii::t('ngp/ip-contact', 'Ip Contact Groups Name'),
        ];
    }

    public static function create(IpContactGroupsForm $form)
    {
        return new self([
            'ip_contact_groups_name' => $form->ip_contact_groups_name,
        ]);
    }

    public function edit(IpContactGroupsForm $form)
    {
        $this->ip_contact_groups_name = $form->ip_contact_groups_name;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIpContacts()
    {
        return $this->hasMany(IpContact::className(), ['ip_contact_groups_id' => 'ip_contact_groups_id'])->from(['ipContacts' => IpContact::tableName()]);
    }
}
