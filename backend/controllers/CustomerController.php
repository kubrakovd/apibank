<?php
namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;
use backend\models\Customer;
use backend\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;

class CustomerController extends ActiveController{
    public function behaviors(){
      return [
            'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
            'index'=>['get'],
            'view'=>['get'],
            'create'=>['post'],
            'update'=>['post'],
            'delete' => ['delete'],
            'deleteall'=>['post'],
            'search'=>['get'],
          ],
        ]
      ];
    }

    public $modelClass = 'backend\models\Customer';

    public function beforeAction($event){
      $action = $event->id;
      if (isset($this->actions[$action])) {
        $verbs = $this->actions[$action];
      } elseif (isset($this->actions['*'])) {
        $verbs = $this->actions['*'];
      } else {
        return $event->isValid;
      }
      $verb = Yii::$app->getRequest()->getMethod();
      $allowed = array_map('strtoupper', $verbs);
      if (!in_array($verb, $allowed)) {
        $this->setHeader(400);
        echo json_encode(array('status'=>0,'error_code'=>400,'message'=>'Method not allowed'),JSON_PRETTY_PRINT);
        exit;
      }
      return true;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    // Create user and Customer
    public function actionCreate(){
        $params=$_REQUEST;
        $user = new User();
        $user->username = $params['name'];
        $user->email = $params['name'].'@'.'ya.ru';
        $user->setPassword(111111);
        $user->generateAuthKey();
        $user->save();

        $model = new Customer();
        $model->customerId = $user->id;
        $model->name = $user->username;
        $model->cnp = $params['cnp'];

      if ($model->save()) {

      echo json_encode(array('status'=>1,'customerId'=>$model->attributes['customerId']),JSON_PRETTY_PRINT);
      }
      else{
      echo json_encode(array('status'=>0,'error_code'=>400,'errors'=>$model->errors),JSON_PRETTY_PRINT);
      }
  }
}
