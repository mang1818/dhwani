<?php

namespace app\modules\api\controllers;
use app\models\User;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use app\modules\api\models\District;

class DistrictController extends ActiveController
{
    public $modelClass = District::class;
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'district',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
		$behaviors['basicAuth'] = [
			'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password) {
                $user = User::find()->where(['username' => $username])->one();
                if ($user->validatePassword($password)) {
                    return $user;
                }
            }
		];
		return $behaviors;
    }
}
