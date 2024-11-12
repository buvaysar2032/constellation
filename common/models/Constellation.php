<?php

namespace common\models;

use common\models\AppActiveRecord;
use Random\RandomException;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%constellation}}".
 *
 * @property int $id
 * @property string $uuid
 * @property string $coordinates
 * @property string|null $name
 * @property string|null $name_en
 * @property string|null $description
 * @property string|null $description_en
 * @property string|null $image
 * @property string|null $user_photo
 * @property int $status
 * @property int $created_at     Дата создания
 * @property int $updated_at     Дата изменения
 * @property int $type
 */
class Constellation extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::class,
            ]
        ]);
    }

    /**
     * @throws Exception
     */
    public function beforeSave($insert): bool
    {
        if ($insert && empty($this->uuid)) {
            $this->uuid = Yii::$app->security->generateRandomString();
        }

        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%constellation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['coordinates'], 'required'],
            [['coordinates'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['uuid', 'name', 'name_en', 'description', 'description_en', 'image', 'user_photo'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uuid' => Yii::t('app', 'Uuid'),
            'coordinates' => Yii::t('app', 'Coordinates'),
            'name' => Yii::t('app', 'Name'),
            'name_en' => Yii::t('app', 'Name En'),
            'description' => Yii::t('app', 'Description'),
            'description_en' => Yii::t('app', 'Description En'),
            'image' => Yii::t('app', 'Image'),
            'user_photo' => Yii::t('app', 'User Photo'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'type' => Yii::t('app', 'Type'),
        ];
    }
}
