<?php
/* @var $this DriverController */

$this->breadcrumbs=array(
	'Driver'=>array('/driver'),
	'Orderdetail',
);

Yii::import('ext.EGMap.*');
 
$gMap = new EGMap();
$gMap->setWidth(500);
$gMap->setHeight(400);
$gMap->zoom = 5;
 

$patient_address=$order['address'];
 
// Create geocoded address
$geocoded_address = new EGMapGeocodedAddress($sample_address);
$geocoded_address->geocode($gMap->getGMapClient());
 
// Center the map on geocoded address
// $gMap->setCenter($geocoded_address->getLat(), $geocoded_address->getLng());
 
 $current = new EGMapCoord($driver['lat'], $driver['lon']);
 
 
 $geocoded_paddress = new EGMapGeocodedAddress($patient_address);
$geocoded_paddress->geocode($gMap->getGMapClient());
 
// Center the map on geocoded address
// $gMap->setCenter($geocoded_address->getLat(), $geocoded_address->getLng());
 
 $patient = new EGMapCoord($geocoded_paddress->getLat(), $geocoded_paddress->getLng());
 
 
 // Initialize GMapDirection
$direction = new EGMapDirection($current, $patient, 'direction_sample');
$direction->provideRouteAlternatives = true;
 
$renderer = new EGMapDirectionRenderer();
$renderer->draggable = true;
$renderer->panel = "direction_pane";
$renderer->setPolylineOptions(array('strokeColor'=>'#FFAA00'));
 
$direction->setRenderer($renderer);
 
$gMap->addDirection($direction);
 

?>
<div class="row">
    <div class="col-lg-6">
         <?php   $gMap->renderMap(); ?>
       </div>
        <div  id="direction_pane"  class="col-lg-6">
            <h2>  <?php echo $order['name']; ?>  </h2>
            

            <address>
               <br>


               <?php echo $order['address'] ?><br/><?php echo $order['city']; ?>,
                    <?php echo $order['zip']; ?>
<br/>
                <abbr title="Phone">Phone:</abbr>     <?php echo $order['phone']; ?><br/>
                <abbr title="Email">Email:</abbr>   <?php echo $order['email']; ?>
            </address>
                 <?php if($order['requestedStrains']!='') echo "<p><strong>Requested Sample: ".$order['requestedStrains'].'</strong></p>'; ?>
 <?php if($order['patientnote']!='') echo " <p> Note to Caregiver: ".$order['patientnote'].'</strong></p>'; ?>

              
            <p><a href="<?php $id=$order['id']; echo $this->createUrl("sales/create",array("id"=>$id)); ?>"
                  class="btn btn-success">Complete Donation</a>   |  <a href="<?php echo $this->createUrl("driver/CancelOrder",array("id"=>$id)); ?>" class="btn btn-danger">Cancel Donation</a></p>
        </div>
    </div>


