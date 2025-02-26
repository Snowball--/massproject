<?php

use yii\db\Migration;

class m250226_194117_createTicketsEntity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(\app\models\Tickets\Ticket::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'status' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250226_194117_createTicketsEntity cannot be reverted.\n";

        return false;
    }
}
