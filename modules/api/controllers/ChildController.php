<?php

namespace app\modules\api\controllers;
use app\models\User;
use yii\rest\ActiveController;
use app\modules\api\models\Child;
use yii\filters\auth\HttpBasicAuth;

class ChildController extends ActiveController
{
    public $modelClass = Child::class;
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'child',
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
