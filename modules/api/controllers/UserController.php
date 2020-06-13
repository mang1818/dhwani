<?php

namespace app\modules\api\controllers;
use app\models\User;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class UserController extends ActiveController
{
    public $modelClass = User::class;
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'users',
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
