<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "translators".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property bool $available_weekdays
 * @property bool $available_weekends
 * @property int $language_from_id
 * @property int $language_to_id
 *
 * @property Languages $languageFrom
 * @property Languages $languageTo
 */
class Translators extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'translators';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'language_from_id', 'language_to_id'], 'required'],
            [['available_weekdays', 'available_weekends'], 'boolean'],
            [['language_from_id', 'language_to_id'], 'default', 'value' => null],
            [['language_from_id', 'language_to_id'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['language_from_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::class, 'targetAttribute' => ['language_from_id' => 'id']],
            [['language_to_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::class, 'targetAttribute' => ['language_to_id' => 'id']],
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
            'email' => 'Email',
            'available_weekdays' => 'Available Weekdays',
            'available_weekends' => 'Available Weekends',
            'language_from_id' => 'Language From ID',
            'language_to_id' => 'Language To ID',
        ];
    }

    /**
     * Gets query for [[LanguageFrom]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguageFrom()
    {
        return $this->hasOne(Languages::class, ['id' => 'language_from_id']);
    }

    /**
     * Gets query for [[LanguageTo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguageTo()
    {
        return $this->hasOne(Languages::class, ['id' => 'language_to_id']);
    }
}
