<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "state".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_by
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => false,
                'updatedByAttribute' => false
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'unique'],
            [['name', 'created_by'],'required'],
            [['created_by', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_by' => 'Created By',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\StateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\StateQuery(get_called_class());
    }
}
