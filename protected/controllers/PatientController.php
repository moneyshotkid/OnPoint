<?php

class PatientController extends Controller
{






/**
	 * Creates a new Patient
 * or redirects patient to order
	 *
	 */
	public function actionCreate()
    {



        if (isset($_POST['Patient']) && isset($_POST['User'])) {

            $User=new User;
            $User->username=$_POST['User']['username'];
            $User->attributes = $_POST['User'];
            $pass=$_POST['User']['password'];
            $User->activkey=sha1(microtime().$pass);
            $User->password=sha1($pass."nguyen102".sha1($pass));
            $User->lat=$_POST['User']['lat'];
            $User->lon=$_POST['User']['lon'];
            $User->createtime=time();
            $transaction = Yii::app()->db->beginTransaction();
            try {
         //       if($User->save()) {
                $User->save();
                    $Patient = new Patient;
                    $Patient->attributes = $_POST['Patient'];
                    $Patient->id = $User->id;
                    $Patient->email = $User->email;
                    $Patient->zip = $_POST['Patient']['zip'];
                    $Patient->save();
                    // Commit the transaction
                    $transaction->commit();

            }
                // Was there an error?
            catch (Exception $e) {
                // Error, rollback transaction
                $transaction->rollback();
            }
                    $activation_url = 'http://' . $_SERVER['HTTP_HOST'] . $this->createUrl('/user/activation/activation', array("activkey" => $User->activkey, "email" => $User->email));
                    $message = new YiiMailMessage;
                    $message->setBody("Please activate you account go to $activation_url", 'text/html');
                    $message->subject = "Confirmation Email (Action Required)";
                    $message->addTo($User->email);
                    $message->from = "noreply@bringmytrees.com";
                    Yii::app()->mail->send($message);
                    Yii::app()->user->setFlash('success', "Your Application has been saved");
                    $this->pageTitle = "New Application Confirmation";
                    return $this->render('success', array(
                        'model' => $Patient));
                }


             //   }


        Yii::app()->clientScript->registerScriptFile("http://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js",CClientScript::POS_END);

            $str = " var geocoder, map, marker;
  var defaultLatLng = new google.maps.LatLng(30,0);

  function initialize() {
    geocoder = new google.maps.Geocoder();
    var mapOptions = {
      zoom: 0,
      center: defaultLatLng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(
      document.getElementById('mapholder'),
      mapOptions
    );
    marker = new google.maps.Marker();
  }

  function validate() {

    var address = document.getElementById('Patient_address').value;
    geocoder.geocode({'address': address }, function(results, status) {
      switch(status) {
        case google.maps.GeocoderStatus.OK:

          document.getElementById('addressconfirmation').innerHTML = '<div onclick=\"confirm(results[0].address_components[0]);\">'+results[0].formatted_address+'</div>';
var lat = results[0].geometry.location.k;
var lon = results[0].geometry.location.D;
console.log(lat);
 document.getElementById('User_lat').value=lat;
		 document.getElementById('User_lon').value=lon;
		var house= results[0].address_components[0].types[0]=='street_number'? results[0].address_components[0].long_name:'';
		var street=results[0].address_components[1].types[0]=='route'? results[0].address_components[1].long_name:'';
		var city=results[0].address_components[2].types[0]=='locality'? results[0].address_components[2].long_name:'';
		var zip=results[0].address_components[6].types[0]=='postal_code'? results[0].address_components[6].long_name:'';
		 document.getElementById('Patient_address').value=results[0].formatted_address;
		 document.getElementById('Patient_city').value=city;
	 document.getElementById('Patient_zip').value=zip;
		document.getElementById('mapholder').style.height='300px';
		document.getElementById('mapholder').style.width='300px';
          mapAddress(results[0]);
          $('#myModal').modal('show');
          break;
        case google.maps.GeocoderStatus.ZERO_RESULTS:
		clearR();
          document.getElementById('addressconfirmation').innerHTML= 'Please enter a valid address';
          break;
        default:
          alert('An error occured while validating this address')
      }
    });
  }

  function clearR() {
   		 document.getElementById('Patient_address').value='';
		 document.getElementById('Patient_city').value='';
 document.getElementById('Patient_zip').value='';
  document.getElementById('User_lon').value='';
    document.getElementById('User_lat').value='';
    map.setCenter(30,0);
    map.setZoom(0);
    marker.setMap(null);
  }

  function mapAddress(result) {
    marker.setPosition(result.geometry.location);
    marker.setMap(map);
    map.fitBounds(result.geometry.viewport);
  }

";



        $url=Yii::app()->request->baseUrl;
            Yii::app()->clientScript->registerScript('geo', $str, CClientScript::POS_END);
            Yii::app()->clientScript->registerScript('geo2', "initialize()", CClientScript::POS_LOAD);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

        $User = new User;
            $model  = new Patient;
        $this->pageTitle = "New Member Application";
        return $this->render('step', array(
                'Patient' => $model,'User'=>$User
            ));

    }


    FUNCTION distance($lat1, $lon1, $lat2, $lon2) {

        $theta = $lon1 - $lon2;
        $dist = SIN(DEG2RAD($lat1)) * SIN(DEG2RAD($lat2)) +  COS(DEG2RAD($lat1)) * COS(DEG2RAD($lat2)) * COS(DEG2RAD($theta));
        $dist = ACOS($dist);
        $dist = RAD2DEG($dist);
        $miles = $dist * 60 * 1.1515;
  RETURN $miles;

    }

public function process(){

    $user = User::model()->findbyPk(Yii::app()->user->id) ;



}


    public function _verifyRec()
    {
        $pid=Yii::app()->user->id;
        $user = User::model()->findbyPk(Yii::app()->user->id) ;

        if(!isset($user->licenseNumber) &&  !isset($user->driverslicense) && !isset($user->patientlicense) && !isset
            ($user->dlCopy)  && !isset($user->recFile) && $user->role=="patient"){
            Yii::app()->user->setFlash('success', "Opps we havent recieved some important legal documents from you
            yet!");
            $disabled=false;
            $this->pageTitle = "State Compliancy Center";
            return $this->actionFiles($disabled);

        }else{
            return $this->actionMenu();

        }

    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Patient::model()->findByPk((int)$id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function actionCancelOrder()
    {
        $id=Yii::app()->user->id;
        Orders::model()->updateAll(array("status"=>'canceled'),"patient_id=:pid",array(':pid'=>$id));
//$o=Orders::model()->findByPk($id);
    //   $o->status="canceled";
    //   if($o->save()) { Yii::app()->user->setFlash('success', "Your Order has been canceled"); }
        Yii::app()->user->setFlash('success', "Your order has been succesfully canceled!");
        return $this->actionMenu();
    }

	public function actionMenu()
	{
      $url=Yii::app()->request->baseUrl;
   Yii::app()->clientScript->registerScriptFile("$url/js/magnify.js",CClientScript::POS_END);
        $pid=Yii::app()->user->id;
        $new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id) ;
        if($new_password->role=="driver" || $new_password->role=="dispatcher"){

            Yii::app()->clientScript->registerScriptFile("$url/js/jquery.masonry.min.js", CClientScript::POS_END);
            Yii::app()->clientScript->registerScript('checkin',"$('#appttime').datetimepicker({
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
    });",CClientScript::POS_READY);
            $data=Inventory::model()->findAll();

            return $this->render('menu',array(
                'model'=>$data,));
        }elseif($pid>0 && Orders::model()->exists("patient_id=:patient_id AND (status=:open OR status=:assigned)",array
        (":patient_id"=>$pid, ":open"=>"open", ":assigned"=>"assigned"))) {

            $sql = "SELECT `id` FROM `orders` WHERE (`status`='open' OR `status`='assigned') AND `patient_id`=$pid LIMIT 1";
            $idd = Yii::app()->db->createCommand($sql)->queryRow();
            $id = $idd['id'];
            /*  if(is_null($id)){
                  $sql="SELECT `id` FROM `orders` WHERE `status`='assigned' AND `patient_id`=$pid LIMIT 1";
                  $idd = Yii::app()->db->createCommand($sql)->queryRow();
                  $id=$idd['id'];
              } */
            return $this->actionOrderdetail($id);
        }
         /*   $sql2="Select
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
            Yii::app()->clientScript->registerScriptFile("http://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js",CClientScript::POS_END);
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
                $geocoded_address = new EGMapGeocodedAddress($order['address']);
                $driver['distance']=$this->distance($geocoded_address->getLat(),$geocoded_address->getLon(),
                    $driver['lat'],$driver['lon']);

                $v_units = round( $driver['distance'] / 45 * 60); //45 MPH
                $v_hours = floor($v_units / 60);
                $v_minutes = round($v_units % 60);
                $driver['eta']=$v_hours.":".$v_minutes;
                Yii::app()->user->setFlash('success', "Your caregiver is on the way!");
                $this->pageTitle = "Driver Confirmed and Enroute";
                $this->render('orderdetail',array('order'=>$order,'driver'=>$driver));
            }else{
                Yii::app()->user->setFlash('info', "Awaiting Caregiver Conformation. If you would like to change
                your order you must cancel this order first.");
                $this->pageTitle = "Order Placed Awaiting Driver Confirmation";
                $this->render('orderdetail',array('order'=>$order));
            }
        }else{ */
            Yii::app()->clientScript->registerScriptFile("$url/js/jquery.masonry.min.js", CClientScript::POS_END);
            Yii::app()->clientScript->registerScript('checkin',"$('#appttime').datetimepicker({
            pickDate: false
        });
          $('#selectable').masonry({
  itemSelector: '.box',
  // set columnWidth a fraction of the container width
  columnWidth: function( containerWidth ) {
    return containerWidth / 3;
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
            });
        }
    });",CClientScript::POS_READY);
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

        $dri= Yii::app()->db->createCommand($sql6)->queryAll();

        $data=Inventory::model()->findAll();
            $this->pageTitle = "Collection";
            return $this->render('menu',array(
                'model'=>$data,'dri'=>$dri));
        }

//PAtient Records Update
	public function actionRecords()
	{
        $id=Yii::app()->user->id;
			$model=Patient::model()->findByPk($id);
        if(isset($_POST['Patient']))
        {
            $model->attributes=$_POST['Patient'];
            if($model->save())
                Yii::app()->user->setFlash('success', "Patient Information Updated");
        }
        $this->pageTitle = "Member Personal Information";
		$this->render('records',array('model'=>$model));
	}

    //Upload Patient Rec and ID
	public function actionFiles($disabled='')
	{

        $disabled=(!$disabled)?" disabled='disbaled' ":'';
        $id=Yii::app()->user->id;
        $model=Patient::model()->findByPk($id);
        if(isset($_POST['Patient']))
        {
            $model->attributes=$_POST['Patient'];
            $model->dlCopy=$_POST['Patient']['dlCopy'];
            $model->recFile=$_POST['Patient']['recFile'];
            if($model->save()){

                Yii::app()->user->setFlash('success', "Thank your records have been updated, we will review and
                validate it shortly");
            }

        }
        $this->pageTitle = "Update Verification Documents";
        $this->render('updatereq',array('model'=>$model, 'disabled'=>$disabled));
    }



        public function actionOrderdetail($id)
    {
        Yii::import('ext.EGMap.*');
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
        Yii::app()->clientScript->registerScriptFile("http://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js",CClientScript::POS_END);
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

            $gMap = new EGMap();
            $driver = Yii::app()->db->createCommand($sql)->queryRow();

            $geocoded_address = new EGMapGeocodedAddress($order['address']);
            $geocoded_address->geocode($gMap->getGMapClient());
            $driver['distance']=$this->distance($geocoded_address->getLat(),$geocoded_address->getLng(),
                $driver['lat'],$driver['lon']);

            $v_units = round( $driver['distance'] / 45 * 60); //45 MPH
           $v_hours = floor($v_units / 60);
           $v_minutes = round($v_units % 60);
            $driver['eta']=$v_hours.":".$v_minutes;


// Center the map on geocoded address
// $gMap->setCenter($geocoded_address->getLat(), $geocoded_address->getLng());

            $gMap->setWidth(500);
            $gMap->setHeight(400);
            $gMap->zoom = 12;



            $patient_address=$order['address'];
            $geocoded_paddress = new EGMapGeocodedAddress($patient_address);
            $geocoded_paddress->geocode($gMap->getGMapClient());
            $gMap->setCenter($geocoded_paddress->getLat(), $geocoded_paddress->getLng());



            if($order['driver_id']>0){
                $patient = new EGMapCoord($geocoded_paddress->getLat(), $geocoded_paddress->getLng());
                $current = new EGMapCoord($driver['lat'], $driver['lon']);
                $geocoded_address = new EGMapGeocodedAddress($current);
                $geocoded_address->geocode($gMap->getGMapClient());
                // Initialize GMapDirection
                $direction = new EGMapDirection($current, $patient, 'direction_sample');
                $direction->provideRouteAlternatives = true;
                $renderer = new EGMapDirectionRenderer();
                $renderer->draggable = true;
                $renderer->panel = "direction_pane";
                $renderer->setPolylineOptions(array('strokeColor'=>'#FFAA00'));
                $direction->setRenderer($renderer);
                $gMap->addDirection($direction);
            }else{
                // Add marker on geocoded address
                $icon=new EGMapMarkerImage('http://bringmytrees.com/images/openpatient.png');
                $gMap->addMarker(
                    new EGMapMarker($geocoded_paddress->getLat(), $geocoded_paddress->getLng(),
                        array('title' =>$order['name'],'icon'=>$icon))
                );
                $icon2=new EGMapMarkerImage('http://bringmytrees.com/images/caricon.png');
                foreach($dri as $ti){
                    $id=$ti['driver_id']; $de=User::model()->findbyPk($id); $name=$de->getFullName();
                    $gMap->addMarker(
                        new EGMapMarker($ti['lat'],$ti['lon'],
                            array('title' =>$name,'icon'=>$icon2))
                    );

                }

            }

            $id=$driver['driver_id'];
            $do=User::model()->findbyPk($id);
            $order['drivername']=$do->getFullName();

            $this->pageTitle = "Driver Confirmed and Enroute";
            $this->render('orderdetail',array('order'=>$order,'driver'=>$driver,'gMap'=>$gMap));
        }else{
            $this->pageTitle = "Order Placed Awaiting Driver Confirmation";
            $this->render('orderdetail',array('order'=>$order,'gMap'=>$gMap));
        }
    }



    public function actionCaregiver($id){
 //       $id=$_GET['order_id'];
$order=Sales::model()->findByPk($id);
        $this->pageTitle = "Caregivers";
        $this->render('caregiver',array('data'=>$order));
    }

    public function actionAjaxAvatar(){
        echo "<img src='http://www.gravatar.com/avatar/".md5( strtolower( trim( $_GET['User_email'] ) ) )."&r=x&d=mm' />";

    }


    /**
     * Handles the AJAX file Uploader
     *  Uploaded Images are resized to 90x120 and thumbnail image names are prefixed {thumb}-imagename.png
     *  To modify uploaded images go to extensions/EAjaxUpload/qqFileUploader.php between line 145-170
     * @returns JSON object {error | filename | thumbname}
     */
    public function actionUpload()
    {
       // ini_set('display_errors','off');
       // display_errors(false);
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $folder='images/patient/';// folder for uploaded files
        $allowedExtensions = array("jpg","png","gif");
        // $sizeLimit = 10 * 1024 * 1024;// Uncomment to place image size validation I removed it cause it was causing errors
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);

        $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        echo $result;// it's array
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