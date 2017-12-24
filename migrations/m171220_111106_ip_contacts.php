<?php

use yii\db\Migration;
use console\helpers\RbacMethodsHelper;
use ngp\helpers\RbacHelper;
use console\helpers\RbacHelper as BaseRbacHelper;

/**
 * Class m171220_111106_ip_contacts
 */
class m171220_111106_ip_contacts extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%ip_contact_groups}}', [
            'ip_contact_groups_id' => $this->primaryKey(),
            'ip_contact_groups_name' => $this->string()->notNull()->unique(),
        ]);

        $this->createTable('{{%ip_contact}}', [
            'ip_contact_id' => $this->primaryKey(),
            'ip_contact_name' => $this->string()->notNull(),
            'ip_contact_phone' => $this->string()->notNull(),
            'ip_contact_groups_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx_contact_groups', '{{%ip_contact}}', ['ip_contact_name', 'ip_contact_phone'], true);
        $this->addForeignKey('ip_contact_groups', '{{%ip_contact}}', 'ip_contact_groups_id', '{{%ip_contact_groups}}', 'ip_contact_groups_id', 'CASCADE');

        RbacMethodsHelper::createRole(RbacHelper::IP_CONTACT_OPERATOR, 'Оператор контактов IP Телефонии',
            RbacMethodsHelper::createPermission(RbacHelper::IP_CONTACT_EDIT, 'Редактирование контактов IP Телефонии'));

        RbacMethodsHelper::assignRole(BaseRbacHelper::ADMINISTRATOR, [
            RbacHelper::IP_CONTACT_OPERATOR,
        ]);

        $this->batchInsert('{{%cardlist}}', [
            'cardlist_page',
            'cardlist_title',
            'cardlist_description',
            'cardlist_style',
            'cardlist_link',
            'cardlist_icon',
            'cardlist_roles',
        ], [
            [
                'wkportal-backend|site/index',
                'Контакты IP телефонии',
                'Добавление/Редактирование/Удаление контактов для IP телефонии',
                'wk-blue-style',
                'FrontendUrlManager[ip-contact]',
                'fa fa-phone-square',
                RbacHelper::IP_CONTACT_OPERATOR,
            ],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ip_contact}}');
        $this->dropTable('{{%ip_contact_groups}}');

        $this->delete('{{%cardlist}}', ['in', 'cardlist_title', [
            'Контакты IP телефонии',
        ]]);
    }
}
