<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%translators}}`.
 */
class m241026_083716_create_translators_table extends Migration
{
    const TABLE = '{{%translators}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'available_weekdays' => $this->boolean()->notNull(),
            'available_weekends' => $this->boolean()->notNull(),
            'language_from_id' => $this->integer()->notNull(),
            'language_to_id' => $this->integer()->notNull(),
        ]);

        // indexes for email
        $this->createIndex('idx-translators-email', self::TABLE, 'email');

        // indexes for languages
        $this->createIndex('idx-translators-language_from_id', self::TABLE, 'language_from_id');
        $this->createIndex('idx-translators-language_to_id', self::TABLE, 'language_to_id');

        // indexes for weekdays and weekends
        $this->createIndex('idx-translators-available_weekdays', self::TABLE, 'available_weekdays');
        $this->createIndex('idx-translators-available_weekends', self::TABLE, 'available_weekends');



        // foreign keys for languages
        $this->addForeignKey(
            'fk-translators-language_from',
            self::TABLE,
            'language_from_id',
            'languages',
            'id',
        );
        $this->addForeignKey(
            'fk-translators-language_to',
            self::TABLE,
            'language_to_id',
            'languages',
            'id',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // remove foreign keys
        $this->dropForeignKey('fk-translators-language_to', self::TABLE);
        $this->dropForeignKey('fk-translators-language_from', self::TABLE);

        // remove indexes
        $this->dropIndex('idx-translators-available_weekends', self::TABLE);
        $this->dropIndex('idx-translators-available_weekdays', self::TABLE);
        $this->dropIndex('idx-translators-language_to_id', self::TABLE);
        $this->dropIndex('idx-translators-language_from_id', self::TABLE);

        // remove table
        $this->dropTable(self::TABLE);
    }
}
