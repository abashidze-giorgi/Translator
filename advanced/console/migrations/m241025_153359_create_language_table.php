<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%language}}`.
 */
class m241025_153359_create_language_table extends Migration
{
    private const TABLE = '{{%languages}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
