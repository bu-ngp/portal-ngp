<?php

use yii\db\Migration;

/**
 * Class m171226_083412_change_ip_contact_unique_index
 */
class m171226_083412_change_ip_contact_unique_index extends Migration
{
    public function up()
    {
        $this->dropIndex('idx_contact_groups', '{{%ip_contact}}');
        $this->createIndex('idx_contact_groups', '{{%ip_contact}}', ['ip_contact_name', 'ip_contact_phone', 'ip_contact_groups_id'], true);
    }

    public function down()
    {
        $this->dropIndex('idx_contact_groups', '{{%ip_contact}}');
        $this->createIndex('idx_contact_groups', '{{%ip_contact}}', ['ip_contact_name', 'ip_contact_phone'], true);
    }
}
