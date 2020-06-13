<?php

namespace app\modules\api\controllers;
use app\models\User;
use app\models\State;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class StateController extends ActiveController
{
    public $modelClass = State::class;
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'states',
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
