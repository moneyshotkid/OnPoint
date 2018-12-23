<?php

class OrdersController extends Controller
{
	public $layout='//layouts/column2';
	private $_model;

	public function filters()
	{
		return array(
			'accessControl', 
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('index','view','create','update'),
				'users'=>array('*'),
			),
			array('allow', 
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', 
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}

	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	public function actionCreate()
	{
		$model=new Orders;

		//$this->performAjaxValidation($model);

		if(isset($_GET['orders']))
		{
			$model->attributes=$_GET['orders'];

			if($model->save())
                Yii::app()->user->setFlash('success', "Hang Tight...as our system is appointing you a caregiver,
                awaiting
                caregiver
                confirmation");
				$this->redirect(array('/patient/orderdetail/'.$model->id));
		}
        $this->pageTitle = "Daily Collection";
        Yii::app()->user->setFlash('success', "Opps Try Again!");
        $this->redirect(array('/patient/menu'));

	}

	public function actionUpdate()
	{
		$model=$this->loadModel();

		$this->performAjaxValidation($model);

		if(isset($_POST['Orders']))
		{
			$model->attributes=$_POST['Orders'];
		
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel()->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,
					Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Orders');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new Orders('search');
		if(isset($_GET['Orders']))
			$model->attributes=$_GET['Orders'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionAssignOrder($order_id,$driver_id){
        $model=  Orders::model()->findbyPk($order_id);
        $model->driver_id=$driver_id;
        $model->status="assigned";
        $model->save();


    }
    public function actionUpdateOrderStatus($order_id,$status=''){
        $model=  Orders::model()->findbyPk($order_id);

        $model->status=$status;
        $model->save();


    }

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Orders::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='orders-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
