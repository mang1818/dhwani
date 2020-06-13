<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $password
 * @property string $authKey
 * @property string $designation
 * @property string $organization
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property State[] $states
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'name', 'password', 'designation'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'name', 'password', 'authKey', 'designation', 'organization'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Name',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'designation' => 'Designation',
            'organization' => 'Organization',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(State::className(), ['created_by' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\api\models\query\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\api\models\query\UserQuery(get_called_class());
    }
}
