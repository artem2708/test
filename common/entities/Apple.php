<?php

namespace common\entities;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "apples".
 *
 * @property int $id
 * @property string $color
 * @property int $created_time
 * @property int $fall_time
 * @property double $percent
 * @property string $status
 */
class Apple extends \yii\db\ActiveRecord
{
    const STATUS_UP = "UP";
    const STATUS_DOWN = "DOWN";
    const STATUS_ROTTEN = "ROTTEN";


    public function init()
    {
        parent::init();

        $this->on(self::EVENT_AFTER_FIND, function ($event) {
            /** @var Apple $model */
            $model = $event->sender;
            if ($model->status == Apple::STATUS_DOWN && $model->fall_time < strtotime('-5 hours')) {
                $model->status = self::STATUS_ROTTEN;
                $model->save();
            }
        });
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_time',
                'updatedAtAttribute' => false,
                'value' => mt_rand(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apples';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_time', 'fall_time'], 'integer'],
            [['percent'], 'number'],
            [['status'], 'string'],
            [['color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'created_time' => 'Created Time',
            'fall_time' => 'Fall Time',
            'percent' => 'Percent',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\db\AppleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\db\AppleQuery(get_called_class());
    }
}
