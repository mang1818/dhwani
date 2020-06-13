<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\User;

class UserController extends ActiveController
{
    public $modelClass = User::class;
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'users',
    ];
}
