<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use app\models\User;
use Aws\S3\S3Client;
use app\models\State;
use yii\web\Response;
use yii\web\Controller;
use app\models\LoginForm;
use yii\web\UploadedFile;
use yii\httpclient\Client;
use app\models\ContactForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\modules\api\models\Child;
use Aws\S3\Exception\S3Exception;
use app\modules\api\models\District;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $userData['name'] = Yii::$app->user->identity->name??'NA';
        $userData['designation'] = Yii::$app->user->identity->name??'NA';
        $userData['organization'] = Yii::$app->user->identity->name??'NA';
        return $this->render('index', ['userData' => $userData]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionDistrict()
    {
        $model = new District();
        $districtQuery = "SELECT d.id, d.name as name, s.name as state_name from district d left join state s ON d.state_id = s.id";
        $district = Yii::$app->db->createCommand($districtQuery)->queryAll();
        $states = State::find()->all();
        $postData = Yii::$app->request->post();
        $postData['District']['status'] = 1;
        $loggedId = Yii::$app->user->identity->id;
        $postData['District']['created_by'] = $loggedId;
        $postData['District']['created_at'] = "";
        $postData['District']['updated_at'] = "";
        if ($model->load($postData) && $model->save()) {
            return $this->redirect('district');
        } else {
            return $this->render('district', [
                'model' => $model,
                'district' => $district,
                'states' => $states
            ]);
        }
    }

    public function actionChild(){
        $model = new Child();
        $childQuery = "SELECT c.id, c.name, c.sex, c.dob, c.father_name, c.mother_name, 
        s.name as state_name, d.name as district_name from child c LEFT JOIN state s ON c.state_id = s.id
        LEFT JOIN district d ON c.district_id = d.id";

        $childList = Yii::$app->db->createCommand($childQuery)->queryAll();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('child');
        } else {
            return $this->render('child', [
                'model' => $model,
                'child' => $childList
            ]);
        }
    }

    public function actionAddChild()
    {
        $model = new Child();
        if ($model->load(Yii::$app->request->post())) {
            $model->created_by = Yii::$app->user->identity->id;
            $image_name = $model->name.'_'.time();
            $imageFile = UploadedFile::getInstance($model, 'image');
            $imageFile->saveAs(Yii::$app->basePath.'/uploads/'.$image_name.'.'.$imageFile->getExtension());
            $s3 = Yii::$app->get('s3');
            // $result = $s3->commands()->get($image_name)->saveAs(Yii::$app->basePath.'/uploads/'.$image_name.'.'.$imageFile->getExtension())->execute();
            // var_dump($result);exit;
            $model->image = '/uploads/'.$image_name.'.'.$imageFile->getExtension();
            if($model->save()){
                return $this->redirect(['child', 'id' => $model->id]);
            }
        } else {
            return $this->render('addChild', [
                'model' => $model,
            ]);
        }
    }

    public function actionList($id)
    {
        $district = District::find()->where(['state_id' => $id])->all();
        if(!empty($district))
        {
            foreach ($district as $key => $value) {
                echo "<option value='".$value->id."'>".$value->name."</option>";
            }
        }
        else
        {
            echo "<option value='0'>NA</option>";
        }
   }

   public function actionStates()
   {
        $model = new State();
        $states = State::find()->all();
        $postData = Yii::$app->request->post();
        $model->status = 1;
        $loggedId = Yii::$app->user->identity->id;
        $model->created_by = $loggedId;
        if ($model->load($postData) && $model->save()) {
            return $this->redirect('states');
        } else {
            return $this->render('states', [
                'model' => $model,
                'states' => $states
            ]);
        }
    }

    public function actionChildView()
    {
        $id = Yii::$app->request->get('id');
        $query = new Query();
        $childDetails = $query->select('c.name as name, c.sex as sex, c.dob as dob, c.father_name, c.mother_name, s.name as state, d.name as district')
        ->from('child c')
        ->JOIN('LEFT JOIN', 'state s', 'c.state_id = s.id')
        ->JOIN('LEFT JOIN', 'district d', 'c.district_id = d.id')
        ->where(['c.id'=>$id])
        ->One();
        return $this->render('childDetails', ['childDetails' => $childDetails]);
    }
}
