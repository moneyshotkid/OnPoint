<?php

class InventoryController extends Controller
{
	public $layout='//layouts/column2';
	private $_model;

	public function filters()
	{
		return array(

		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('index','view','aclist','Upload'),
				'users'=>array('*'),
			),
			array('allow', 
				'actions'=>array('create','update'),
				'users'=>array('@','jimmy','nick'),
			),
			array('allow', 
				'actions'=>array('admin','delete'),
				'users'=>array('admin','owner','jimmy','nick'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}
public function actions()
  {
    return array(
      'aclist'=>array(
        'class'=>'application.extensions.EAutoCompleteAction',
        'model'=>'strains', //My model's class name
        'attribute'=>'strain', //The attribute of the model i will search
      ),
    );
  }
	public function actionView()
	{
		$this->render('view',array(
			'data'=>$this->loadModel($_GET['id']),
		));
	}

    public function actionMenu()
    {
        $url = Yii::app()->request->baseUrl;
        Yii::app()->clientScript->registerScriptFile("$url/js/magnify.js", CClientScript::POS_END);
        $pid = Yii::app()->user->id;
        $new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
        if ($new_password->role == "driver" || $new_password->role == "dispatcher") {

            Yii::app()->clientScript->registerScriptFile("$url/js/jquery.masonry.min.js", CClientScript::POS_END);
            Yii::app()->clientScript->registerScript('checkin', "$('#appttime').datetimepicker({
            pickDate: false
        });
          $('#selectable').masonry({
  itemSelector: '.box',
  columnWidth: function( containerWidth ) {
    return containerWidth /3;
 }, });
$( '#selectable' ).bind('mousedown', function(e) {
    e.metaKey = true;
}).selectable({
    filter: ' > div',
     stop: function() {
            var result = $( '#requestedStrains' ).empty();
            var selected=[];

            $( '.ui-selected', this ).each(function() {
            selected.push(this.id);
                $( '#requestedStrains' ).val(selected.join(', '));
                  $( '#strainsd' ).text(selected.join(', '));
            });
        }
    });", CClientScript::POS_READY);
            $data = Inventory::model()->findAll();

            return $this->render('menu', array(
                'model' => $data,));
        }

    }


	public function actionCreate()
	{
		$model=new Inventory;

		//$this->performAjaxValidation($model);

		if(isset($_POST['Inventory']))
		{
			$model->attributes=$_POST['Inventory'];
            $model->employee_id=Yii::app()->user->id;
$model->vendor_id=5;

			if($model->save()){
                Yii::app()->user->setFlash('success', "Inventory Added!");
				$this->redirect(array('/dispatcher/map'));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate()
	{
		$model=$this->loadModel($_GET['id']);

		$this->performAjaxValidation($model);

		if(isset($_POST['Inventory']))
		{
			$model->attributes=$_POST['Inventory'];
		
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
			$this->loadModel($_GET['id'])->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,
					Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Inventory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

/**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Inventory('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Inventory']))
            $model->attributes=$_GET['Inventory'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    
public function actionUpload()
{

    // ini_set('display_errors','off');
    // display_errors(false);
    Yii::import("ext.EAjaxUpload.qqFileUploader");
    //$image=new Image;
    $url=Yii::app()->request->baseUrl;

    $folder='images/inventory/';// folder for uploaded files
    $allowedExtensions = array("jpg","png","gif");
    // $sizeLimit = 10 * 1024 * 1024;// Uncomment to place image size validation I removed it cause it was causing errors
    $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
    $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
    $result = $uploader->handleUpload($folder);

    $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    echo $result;// it's array

}



  /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Inventory::model()->findByPk((int)$id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='inventory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
