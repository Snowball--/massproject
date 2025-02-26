<?php

use app\models\Tickets\Ticket;
use app\models\Tickets\TicketStatusEnum;
use yii\db\Migration;

class m250226_194117_createTicketsEntity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Ticket::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'status' => $this->string(255)->defaultValue(TicketStatusEnum::Active->name),
            'message' => $this->text(),
            'comment' => $this->text()->null()->defaultValue(null),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Ticket::tableName());
    }
}
