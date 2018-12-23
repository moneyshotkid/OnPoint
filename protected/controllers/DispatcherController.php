<?php

class DispatcherController extends Controller
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
                'actions'=>array('create','Drivers','Map','Users','OrderDetail','AssignOrder','Assign','update'),
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

    public function actionBalancesheet()
	{
        $model= Driverbalancesheet::model()->findAll();
		$this->render('balancesheet',array('model'=>$model));
	}

	public function actionDrivers()
	{
        $sql="Select
  users.driverstatus,
  users.role,
  users.lastvisit,
  users.email,
  users.username,
  users.lastcheckin,
  users.status
From
  lh_users as users
Where
  users.role = 'driver'";
        $drivers = Yii::app()->db->createCommand($sql)->queryAll();
        $this->pageTitle = "Drivers - Dispatcher Overview";
		$this->render('drivers',array('drivers'=>$drivers));
	}

    public function actionSales($id)
    {
$drivers=Sales::model()->sales($id);
        $this->render('sales',array('drivers'=>$drivers));
    }
    public function actionAssignOrder(){
        $order_id=$_POST['oid'];
        $driver_id=$_POST['did'];
      $model=  Orders::model()->findByPk($order_id);
        $model->driver_id=$driver_id;
        $model->status="assigned";
        Yii::app()->user->setFlash('success', "Order Assigned");

       $model->save();


    }
    public function actionUpdateOrderStatus($order_id,$status=''){
        $model=  Orders::model()->findByPk($order_id);
        $model->status=$status;
        Yii::app()->user->setFlash('success', "Order Closed");
        $model->save();


    }

public function actionUsers(){

    $model= User::model()->findAll();
   // $model->unsetAttributes();


    $this->render('users',array(
        'model'=>$model,
    ));

}



	public function actionMap()
	{

$sql="Select
  driverlocation.driver_id,
  driverlocation.lat,
  driverlocation.lon,
  driverlocation.timestamp
From
  driverlocation Inner Join
  (Select
    driverlocation.driver_id,
    Max(driverlocation.timestamp) As timestamp FROM driverlocation
  Group By
    driverlocation.driver_id) t2 On driverlocation.timestamp = t2.timestamp And
    driverlocation.driver_id = t2.driver_id";

        $drivers = Yii::app()->db->createCommand($sql)->queryAll();
        $sql2="Select
  orders.id,
  orders.driver_id,
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
  orders.status = 'open' AND  orders.driver_id=0";
        $openorders = Yii::app()->db->createCommand($sql2)->queryAll();
        $sql3="Select
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
  orders.status = 'assigned'";
        $url=Yii::app()->request->baseUrl;
        $assigned = Yii::app()->db->createCommand($sql3)->queryAll();
        Yii::app()->clientScript->registerScriptFile("$url/js/gmap3.js",CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile("$url/js/jquery.timeago.js",CClientScript::POS_END);
        $str="jQuery(document).ready(function() {
  jQuery('abbr.timeago').timeago();
});
$('#map').gmap3({
          map:{
        options:{
            center:[33.717471,-117.831143],
              zoom: 11
            }
    },
          marker:{
        values:[";

foreach($drivers as $driver){
    $id=$driver['driver_id']; $d=User::model()->findbyPk($id); $name= $d->getFullName();
    $str.="{latLng:[{$driver['lat']}, {$driver['lon']}], data:'CareGiver {$name}',
    options:{icon:'http://bringmytrees.com/images/caricon.png'}},";

}
foreach($openorders as $order){
    $str.="{address:'{$order['address']} {$order['city']} {$order['zip']}',data:'Unassigned Patient {$order['name']}',
    options:{icon:'http://bringmytrees.com/images/openpatient.png'}},";
}

$str .="],
            options:{
            draggable: false
            },
            events:{
            mouseover: function(marker, event, context){
                var map = $(this).gmap3('get'),
                  infowindow = $(this).gmap3({get:{name:'infowindow'}});
                if (infowindow){
                    infowindow.open(map, marker);
                    infowindow.setContent(context.data);
                } else {
                    $(this).gmap3({
                    infowindow:{
                        anchor:marker,
                      options:{content: context.data}
                    }
                  });
                }
              },
            mouseout: function(){
                var infowindow = $(this).gmap3({get:{name:'infowindow'}});
                if (infowindow){
                    infowindow.close();
                }
              }
        }
          }
        });";
        $str2="$('#map').gmap3();";
        Yii::app()->clientScript->registerScript('gmap3',$str,CClientScript::POS_READY);



        $this->pageTitle = "Dispatcher Dashboard";
		$this->render('map',array('drivers'=>$drivers,'openorders'=>$openorders,'assigned'=>$assigned));
	}


    FUNCTION distance($lat1, $lon1, $lat2, $lon2) {

        $theta = $lon1 - $lon2;
        $dist = SIN(DEG2RAD($lat1)) * SIN(DEG2RAD($lat2)) +  COS(DEG2RAD($lat1)) * COS(DEG2RAD($lat2)) * COS(DEG2RAD($theta));
        $dist = ACOS($dist);
        $dist = RAD2DEG($dist);
        $miles = $dist * 60 * 1.1515;
        RETURN $miles;

    }


    public function actionOrderdetail($id)
    {
        $sql2="Select
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
        $address = $order['address']; // Google HQ
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $order['lat'] = $output->results[0]->geometry->location->lat;
        $order['lon'] = $output->results[0]->geometry->location->lng;
        if($order['driver_id']>0)    {
            $driver_id= $order['driver_id'];
            $sql="Select
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
$s="Select
  lh_users.id,
  lh_users.username
From
  lh_users
Where
  lh_users.role = 'driver'";
            $d = Yii::app()->db->createCommand($s)->queryAll();
            $this->pageTitle = "Assigned Order Detail Dispather Overview";
            $this->render('orderdetail',array('order'=>$order,'driver'=>$driver,'d'=>$d));
        }else{

            /*
             * UNASSSIGNED
             */
            $sql6="Select
  driverlocation.driver_id,
  driverlocation.lat,
  driverlocation.lon,
  driverlocation.timestamp
From
  driverlocation Inner Join
  (Select
    driverlocation.driver_id,
    Max(driverlocation.timestamp) As timestamp FROM driverlocation
  Group By
    driverlocation.driver_id) t2 On driverlocation.timestamp = t2.timestamp And
    driverlocation.driver_id = t2.driver_id";
            $this->pageTitle = "Unassigned Order Detail - Dispather";
            $dri= Yii::app()->db->createCommand($sql6)->queryAll();

            $this->render('orderdetail',array('order'=>$order,'dri'=>$dri));
        }
    }


public function actionAssign(){
    $driver_id=$_POST['did'];
$id=$_POST['oid'];
    if($id>0 && $driver_id>0){
    $ord=Orders::model()->findbyPk($id);
    $ord->status="assigned";
    $ord->driver_id=$driver_id;
    if($ord->save()){echo 1;}else{echo  2;}}}


}