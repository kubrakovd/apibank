<?php

namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;
use backend\models\Transaction;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\data\Pagination;

class TransactionController extends ActiveController{
	// Set actions and methods
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

	public $modelClass = 'backend\models\Transaction';

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
	// Unset existed actions
	public function actions(){
		$actions = parent::actions();
		unset($actions['create'], $actions['index'],$actions['view'],$actions['delete'],$actions['update']);
		return $actions;
	}
	// Create function Create
	public function actionCreate(){
		$model = new Transaction();
		$model->date = date(time());
		$model->load(Yii::$app->request->post(),'');
		$model->save();
		echo json_encode(array('date'=>$model['date'],'transactionId'=>$model['transactionId'],'customerId'=>$model['customerId'],'amount'=>$model['amount']),JSON_PRETTY_PRINT);
	}

	// Create function Delete
	public function actionDelete($transactionId){
      $model=$this->findModel($transactionId);
      if($model->delete()){
      $this->setHeader(200);
      echo json_encode(array('status'=>'Success','data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);
      }
      else{
      $this->setHeader(400);
      echo json_encode(array('status'=>'Fail','error_code'=>400,'errors'=>$model->errors),JSON_PRETTY_PRINT);
      }
  }

	// Create function Index
	public function actionIndex(){
    	$params=$_REQUEST;
          $filter=array();
          $sort="";
          $page=1;
          $limit='';
           if(isset($params['page']))$page=$params['page'];
           if(isset($params['limit'])) $limit=$params['limit'];
            $offset=$limit*($page-1);

            /* Filter elements */
           	if(isset($params['filter'])){
             $filter=(array)json_decode($params['filter']);
            }
             if(isset($params['datefilter'])){
             $datefilter=(array)json_decode($params['datefilter']);
            }
            if(isset($params['sort'])){
              $sort=$params['sort'];
	         	if(isset($params['order'])){
            if($params['order']=="false")
             $sort.=" desc";
            else
             $sort.=" asc";
		        }
            }
            	// Creating Query
               $query=new Query;
               $query->offset($offset)
                 ->limit($limit)
                 ->from('transaction')
                 ->orderBy($sort)
                  ->select("transactionId,customerId,amount,date");
				if(isset($filter['customerId']) && $filter['customerId']){
		                 $query->andFilterWhere(['like', 'customerId', $filter['customerId']]);
	            }
		       if(isset($filter['amount']) && $filter['amount']){
	                 $query->andFilterWhere(['like', 'amount', $filter['amount']]);
	            }
	           if(isset($datefilter['from']) && $datefilter['from']){
	            $query->andWhere("date >= '".$datefilter['from']."' "); }
	           if(isset($datefilter['to']) && $datefilter['to']){
	            $query->andWhere("date <= '".$datefilter['to']."'");
	           }
           $command = $query->createCommand();
               $models = $command->queryAll();
               $totalItems=$query->count();

          $this->setHeader(200);

          echo json_encode(array('status'=>1,'data'=>$models,'totalItems'=>$totalItems),JSON_PRETTY_PRINT);
    }

    // Create Search Transaction
    public function actionSearch(){
    	if (Yii::$app->user->isGuest){
    		echo "You don't have permission to this operation";
    	}else{
    		$model = new Transaction();
    		$amount = isset($_GET['Transaction']['amount'])?$_GET['Transaction']['amount']:'';
    		$customerId = isset($_GET['Transaction']['customerId'])?$_GET['Transaction']['customerId']:'';
    		$date = isset($_GET['Transaction']['date'])?strtotime($_GET['Transaction']['date']):'';
    		$dateday = !empty($_GET['Transaction']['date'])?$date+86400:'';
    		$params=$_REQUEST;
          // Creating filter from form
    		$filter=['amount'=>$amount, 'customerId'=>$customerId];
    		$datefilter = ['from'=>$date, 'to'=>$dateday];
    		$sort="";
    		$limit='';
    		if(isset($params['page']))
    			$page=$params['page'];

    		if(isset($params['limit']))
    			$limit=$params['limit'];

    		$offset='';

    		/* Filter elements */
    		if(isset($params['filter'])){
    			$filter=(array)json_decode($params['filter']);
    		}

    		if(isset($params['datefilter'])){
    			$datefilter=(array)json_decode($params['datefilter']);
    		}

    		if(isset($params['sort'])){
    			$sort=$params['sort'];
    			if(isset($params['order'])){
    				if($params['order']=="false")
    					$sort.=" desc";
    				else
    					$sort.=" asc";
    			}
    		}
            // Creating Query
    		$query=new Query;
    		$query->offset($offset)
    		->limit($limit)
    		->from('transaction')
    		->orderBy($sort)
    		->select("transactionId,customerId,amount,date");
    		if(isset($filter['customerId']) && $filter['customerId']){
    			$query->andFilterWhere(['like', 'customerId', $filter['customerId']]);
    		}
    		if(isset($filter['amount']) && $filter['amount']){
    			$query->andFilterWhere(['like', 'amount', $filter['amount']]);
    		}
    		if(isset($datefilter['from']) && $datefilter['from']){
    			$query->andWhere("date >= '".$datefilter['from']."' "); }
    			if(isset($datefilter['to']) && $datefilter['to']){
    				$query->andWhere("date <= '".$datefilter['to']."'");
    			}
    			$command = $query->createCommand();
    			$models = $command->queryAll();

    			$totalItems=$query->count();

    			$this->setHeader(200);

    			$data = json_encode(array('models'=>$models,'totalItems'=>$totalItems),JSON_PRETTY_PRINT);

    			$pagination = new Pagination(['totalCount'=>$totalItems]);
    			$pagination->defaultPageSize = isset($params['per_page'])?$params['per_page']:5;
    			$pag_query =$query->offset($pagination->offset)
    			->limit($pagination->limit)
    			->all();

    			return $this->render('search', [
    				'pag_query' => $pag_query,
    				'models' => $models,
    				'model'=> $model,
    				'totalItems' => $totalItems,
    				'pagination'=> $pagination,
    				]) ;
    		}
    	}

    // Creating View
    public function actionView($transactionId){
    	$model=$this->findModel($transactionId);
    	$this->setHeader(200);
    	echo json_encode(array('status'=>1,'data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);
    }
    /* function to find the requested record/model */
    protected function findModel($transactionId){
    	if (($model = Transaction::findOne($transactionId)) !== null) {
    		return $model;
    	} else {
    		$this->setHeader(400);
    		echo json_encode(array('status'=>0,'error_code'=>400,'message'=>'Bad request'),JSON_PRETTY_PRINT);
    		exit;
    	}
    }
    // Creating Update
    public function actionUpdate($transactionId){
    	$params=$_REQUEST;
    	$model = $this->findModel($transactionId);
    	$model->attributes=$params;
    	if ($model->save()){
    		$this->setHeader(200);
    		echo json_encode(array('status'=>1,'data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);
    	}
    	else{
    		$this->setHeader(400);
    		echo json_encode(array('status'=>0,'error_code'=>400,'errors'=>$model->errors),JSON_PRETTY_PRINT);
    	}
    }
    /* Functions to set header with status code. eg: 200 OK ,400 Bad Request etc..*/
    public function setHeader($status){
    	$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    	$content_type="application/json; charset=utf-8";
    	header($status_header);
    	header('Content-type: ' . $content_type);
    	header('X-Powered-By: ' . "Nintriva <nintriva.com>");
    }
    public function _getStatusCodeMessage($status){
    	$codes = Array(
    		200 => 'OK',
    		400 => 'Bad Request',
    		401 => 'Unauthorized',
    		402 => 'Payment Required',
    		403 => 'Forbidden',
    		404 => 'Not Found',
    		500 => 'Internal Server Error',
    		501 => 'Not Implemented',
    		);
    	return (isset($codes[$status])) ? $codes[$status] : '';
    }
}
