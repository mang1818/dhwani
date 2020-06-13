<?php

namespace app\modules\api\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "child".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sex
 * @property string $dob
 * @property string $father_name
 * @property string $mother_name
 * @property integer $state_id
 * @property integer $district_id
 * @property integer $created_by
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $image
 */
class Child extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

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
    
    public static function tableName()
    {
        return 'child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sex', 'dob', 'state_id', 'district_id', 'created_by'], 'required'],
            [['sex', 'state_id', 'district_id', 'created_by', 'status', 'created_at', 'updated_at'], 'integer'],
            [['dob'], 'safe'],
            [['name', 'father_name', 'mother_name', 'image'], 'string', 'max' => 255],
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
            'sex' => 'Sex',
            'dob' => 'Dob',
            'father_name' => 'Father Name',
            'mother_name' => 'Mother Name',
            'state_id' => 'State ID',
            'district_id' => 'District ID',
            'created_by' => 'Created By',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'image' => 'Image',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\modules\api\models\query\ChildQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\api\models\query\ChildQuery(get_called_class());
    }
}
