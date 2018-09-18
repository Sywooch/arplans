<?php

use yii\db\Migration;

/**
 * Class m180917_091217_add_contacts_to_partner
 */
class m180917_091217_add_contacts_to_partner extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('partner', 'address', $this->string());
        $this->addColumn('partner', 'phones', $this->string());
        $this->addColumn('partner', 'price_list', $this->string());
        $this->addColumn('partner', 'logo', $this->string());
        $this->addColumn('partner', 'image_id', $this->integer()->unsigned());
        $this->addColumn('village', 'image_id', $this->integer()->unsigned());
        $this->addForeignKey('FK_partner_image', 'partner', 'image_id', 'partner_image', 'id');
        $this->addForeignKey('FK_village_image', 'village', 'image_id', 'village_image', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_partner_image','partner');
        $this->dropForeignKey('FK_village_image','village');
        $this->dropColumn('partner', 'address');
        $this->dropColumn('partner', 'phone');
        $this->dropColumn('partner', 'price_list');
        $this->dropColumn('partner', 'logo');
        $this->dropColumn('partner', 'image_id');
        $this->dropColumn('village', 'image_id');
    }

}