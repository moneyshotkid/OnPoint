<?php

class SalesController extends Controller
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
				'actions'=>array('index','view','test','create','order','CloseOrder'),
				'users'=>array('*'),
              //  'roles'=>array('owner'),
			),
			array('allow', 
				'actions'=>array('update'),
				//'users'=>array('@'),
                 'roles'=>array('driver','dispatcher','admin'),
			),
			array('allow', 
				'actions'=>array('admin','delete'),
				'users'=>array('admin','jimmy','nick'),
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

    public function actionOrder($order_id)
    {
        $model=new Sales();
        $itemmodel=new Item;
        $inventory=new Inventory;
        //	$this->performAjaxValidation($model);

        if(isset($_POST['Sales']))
        {
            $model->attributes=$_POST['Sales'];
            //$item=item::model()->findByPk();
            $model->leadin==new CDbExpression('NOW()');




            if($model->save())
                $arrItems=$_POST['item'];
            $tot=sizeof($_POST['item']['inventory_id']);
            for ($v=0;$v<$tot;$v++) {
                $inv=Inventory::model()->findByPk($arrItems['inventory_id'][$v]);
                $newweight=$inv->currentweight - $arrItems['quantity'][$v];
                $inv->currentweight=$newweight;
                $inv->save();
                $arrItems['sales_id'][$v]=$model->id;
                $itemmodel->attributes=	$arrItems;
                $itemmodel->save(false);
            }
            $this->pageTitle = "Donation Reciept";
            $this->redirect(array('patient/caregiver','id'=>$model->id));
        }
        $this->pageTitle = "Donation Form";
        $this->render('create',array(
            'model'=>$model,'itemmodel'=>$itemmodel
        ));
    }






    public function actionCreate($order_id=0)
	{
      $order_id=$_GET['id'];
		$model=new Sales();

$inventory=new Inventory;
        if($order_id>0){$order=Orders::model()->findbyPk($order_id);}else{$order=new Orders;$order->id=0;};
	//	$this->performAjaxValidation($model);
//Form submitted
		if(isset($_POST['Sales'])) {
            //SAving form data
            $model->attributes = $_POST['Sales'];
            //$item=item::model()->findByPk();
            if ($model->save()) {
                $arrItems = $_POST['item'];
                $tot = sizeof($_POST['item']['inventory_id']);
                for ($v = 0; $v < $tot; $v++) {
                    $inv = Inventory::model()->findByPk($arrItems['inventory_id'][$v]);
                    $newweight = $inv->currentweight - $arrItems['quantity'][$v];
                    $inv->currentweight = $newweight;
                    $inv->save();
                    //Save each Item
                    $itemmodel=new Item();
                    $itemmodel->sales_id=$model->id;
                    $itemmodel->inventory_id=$arrItems['inventory_id'][$v];
                    $itemmodel->quantity=$arrItems['quantity'][$v];
                    $itemmodel->cost=$arrItems['cost'][$v];
                    $itemmodel->systemcost=$arrItems['systemcost'][$v];
                    $itemmodel->save();
                  //Update Order Status to closed
                    $order->driver_id = Yii::app()->user->id;
                    $order->status = "closed";
                    $order->save();
                    Yii::app()->user->setFlash('success', "Order Closed");
                }
                $this->redirect(array('patient/caregiver', 'id' => $model->id));
            }
        }
        $this->pageTitle = "Donation Form";
		$this->render('create',array(
			'model'=>$model,'itemmodel'=>$itemmodel,'order'=>$order
		));
	}

    public function actionCloseOrder($order_id){
        $model=  Orders::model()->findByPk($order_id);
        $model->driver_id=Yii::app()->user->id;
        $model->status="closed";
        $model->save();
        Yii::app()->user->setFlash('success', "Order Closed");


    }

	public function actionUpdate()
	{
		$model=$this->loadModel();

		$this->performAjaxValidation($model);

		if(isset($_POST['sales']))
		{
			$model->attributes=$_POST['sales'];
		
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
		$dataProvider=new CActiveDataProvider('sales');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new sales('search');
		if(isset($_GET['sales']))
			$model->attributes=$_GET['sales'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=sales::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sales-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
