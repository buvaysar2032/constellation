<?php

use yii\db\Migration;

/**
 * Class m241112_123058_add_i_setting
 */
class m241112_123058_add_i_setting extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->insert('{{%setting}}', [
            'parameter' => 'i',
            'value' => '5',
            'description' => 'i подготовленные',
            'type' => 'number'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->delete('{{%setting}}', ['parameter' => 'i']);
    }
}
