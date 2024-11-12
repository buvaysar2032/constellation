<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%constellation}}`.
 */
class m241112_074025_create_constellation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp(): void
    {
        $this->createTable('{{%constellation}}', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string()->notNull(),
            'coordinates' => $this->text()->notNull(),
            'name' => $this->string(),
            'name_en' => $this->string(),
            'description' => $this->string(),
            'description_en' => $this->string(),
            'image' => $this->string(),
            'user_photo' => $this->string(),
            'status' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull()->comment('Дата создания'),
            'updated_at' => $this->integer()->notNull()->comment('Дата изменения'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown(): void
    {
        $this->dropTable('{{%constellation}}');
    }
}
