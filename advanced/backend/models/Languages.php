<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string $name
 *
 * @property Translators[] $translators
 * @property Translators[] $translators0
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Translators]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTranslators()
    {
        return $this->hasMany(Translators::class, ['language_from_id' => 'id']);
    }

    /**
     * Gets query for [[Translators0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTranslators0()
    {
        return $this->hasMany(Translators::class, ['language_to_id' => 'id']);
    }
}
