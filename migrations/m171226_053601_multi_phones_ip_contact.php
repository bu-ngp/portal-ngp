<?php

use yii\db\Migration;

/**
 * Class m171226_053601_multi_phones_ip_contact
 */
class m171226_053601_multi_phones_ip_contact extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%ip_contact}}', 'ip_contact_phone2', $this->string());
        $this->addColumn('{{%ip_contact}}', 'ip_contact_phone3', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ip_contact}}', 'ip_contact_phone2');
        $this->dropColumn('{{%ip_contact}}', 'ip_contact_phone3');
    }
}
