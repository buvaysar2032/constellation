<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%constellation}}`.
 */
class m241112_101924_add_type_column_to_constellation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->addColumn('{{%constellation}}', 'type', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropColumn('{{%constellation}}', 'type');
    }
}
