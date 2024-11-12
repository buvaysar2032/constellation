<?php

use yii\db\Migration;

/**
 * Class m241112_122205_add_n_setting
 */
class m241112_122205_add_n_setting extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->insert('{{%setting}}', [
            'parameter' => 'n',
            'value' => '5',
            'description' => 'n пользовательские',
            'type' => 'number'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->delete('{{%setting}}', ['parameter' => 'n']);
    }
}
