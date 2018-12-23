<?php

class DriverController extends Controller
{


    public function filters()
    {
        return array();
    }


        public function accessRules()
        {
            return array(
                array('allow',
                    'actions'=>array('index','view'),
                    'users'=>array('*'),
                ),
                array('allow',
                    'actions'=>array('create','Checkin','CloseOrder','CancelOrder','Donation','Orders','Orderdetail',
                        'update'),
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


    public function actionCheckin()
    {
        $model = new DriverLocation;
        $user = User::model()->findByPk(Yii::app()->user->id);
        if ($user->role == "driver") {
            $user->lastcheckin = new CDbExpression('NOW()');
            $user->lat = $_POST['lat'];
            $user->lon = $_POST['lon'];
            $user->driverstatus = (int)$_POST['status'];
            $model->driver_id = Yii::app()->user->id;
            $model->lat = $_POST['lat'];
            $model->lon = $_POST['lon'];
            $model->timestamp = new CDbExpression('NOW()');
            $user->save();
            $model->save();
        }
    }


    public function actionCloseOrder($order_id)
    {
        $model = Orders::model()->findByPk($order_id);
        $model->driver_id = Yii::app()->user->id;
        $model->status = "closed";
        $model->save();
        Yii::app()->user->setFlash('success', "Order Closed");
    }


    public function actionCancelOrder($order_id)
    {
        $model = Orders::model()->findByPk($order_id);
        $model->driver_id = Yii::app()->user->id;
        $model->status = "canceled";
        $model->save();
        Yii::app()->user->setFlash('success', "Order Canceled");
$this->render("orders");

    }

    public function actionDonation($id=0)
    {
        $order = Orders::model()->findByPk($id);
        //$this->actionCloseOrder($id);
        //Driver Confirmin order
        if (!is_null($order) && $order!=0) {
            $sale = new Sales();
            $sale->order_id = $id;
            $sale->patient_id = $order->patient_id;
            $sale->employee_id = Yii::app()->user->id;
            $sale->date = new CDbExpression('NOW()');
            Yii::app()->user->setFlash('success', "Wonderful Complete the donation form below!!");
            $this->redirect(array("sales/create",'order_id' => $id));
                 } else {
            //This is budtender no order_id
            $sale = new Sales();
            $sale->employee_id = Yii::app()->user->id;
            $sale->date = new CDbExpression('NOW()');
            $this->redirect(array("sales/create"));
        }
    }

    public function actionConfirminventory()
    {
        $this->render('confirminventory');
    }


    public function actionOrders()
    {
        $url = Yii::app()->request->baseUrl;
        Yii::app()->clientScript->registerScriptFile("$url/js/jquery.timeago.js", CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile("http://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js", CClientScript::POS_END);
        Yii::app()->clientScript->registerScript('checkin', "GMaps.geolocate({
            success: function(position){
var status= this.id=='checkout'?0:1;
                $.ajax({
                    url: '$url/index.php/driver/Checkin',
                    type: 'POST',
                    data: { lat : position.coords.latitude , lon : position.coords.longitude,status:status},
                    dataType: 'text'
                }).done(function(){ location.reload();

                    });

            },
            error: function(error){
                alert('Geolocation failed: '+error.message);
            },
            not_supported: function(){
                alert('Your browser does not support geolocation');
            }

        });

  jQuery(document).ready(function() {
  jQuery('abbr.timeago').timeago();
});", CClientScript::POS_END);
        $id = Yii::app()->user->id;
        $sql = "Select
  orders.id,
  orders.requestedStrains,
  orders.Timein,
  orders.patientnote,
  orders.PrefDeliveryTime,
  patient.id As pid,
  patient.name,
  patient.email,
  patient.address,
  patient.city,
  patient.zip,
  patient.phone,
  orders.status,
  orders.driver_id
From
  orders Inner Join
  patient On orders.patient_id = patient.id
Where
  orders.status = 'open'";
        $openorders = Yii::app()->db->createCommand($sql)->queryAll();

        $sql2 = "Select
  orders.id,
  orders.requestedStrains,
  orders.Timein,
  orders.patientnote,
  orders.PrefDeliveryTime,
  patient.id As pid,
  patient.name,
  patient.email,
  patient.address,
  patient.city,
  patient.zip,
  patient.phone,
  orders.status,
  orders.driver_id
From
  orders Inner Join
  patient On orders.patient_id = patient.id
Where
  orders.status = 'assigned' And
  orders.driver_id = $id";
        $myorders = Yii::app()->db->createCommand($sql2)->queryAll();
        $this->render('orders', array('openorders' => $openorders, 'myorders' => $myorders));
    }

    public function actionCaregiver($id)
    {
        //       $id=$_GET['order_id'];
        $order = Orders::model()->findByPk($id);

        $this->render('caregiver', array('data' => $order));
    }


    public function actionOrderdetail($id)
    {
        $sql2 = "Select
  orders.id,
  orders.requestedStrains,
  orders.Timein,
  orders.patientnote,
  orders.PrefDeliveryTime,
  patient.id As pid,
  patient.name,
  patient.email,
  patient.address,
  patient.city,
  patient.zip,
  patient.phone,
  orders.status,
  orders.driver_id
From
  orders Inner Join
  patient On orders.patient_id = patient.id
Where
  orders.id = $id";
        $order = Yii::app()->db->createCommand($sql2)->queryRow();
        Yii::app()->clientScript->registerScriptFile("http://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js", CClientScript::POS_END);
        if ($order['driver_id'] > 0) {
            $driver_id = $order['driver_id'];
            $sql = "Select
  driverlocation.timestamp,
  driverlocation.lat,
  driverlocation.lon,
  driverlocation.driver_id
From
  driverlocation
Where
  driverlocation.driver_id = $driver_id Order By
  driverlocation.timestamp Desc
Limit 1";
            $driver = Yii::app()->db->createCommand($sql)->queryRow();

            $this->render('orderdetail', array('order' => $order, 'driver' => $driver));
        } else {
            $this->render('orderdetail', array('order' => $order));
        }
    }

    public function actionUpdateLocation()
    {
        $model = new DriverLocation();
        $model->driver_id = Yii::app()->user->id;
        $model->lat = $_POST['lat'];
        $model->lon = $_POST['lon'];
        $model->timestamp = new CDbExpression('NOW()');
        $model->save();
    }


    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */
}