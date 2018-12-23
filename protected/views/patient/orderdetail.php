<?php
/* @var $this DriverController */

$this->breadcrumbs=array(
    'Driver'=>array('/driver'),
    'Orderdetail',
);

// Center the map on geocoded address
// $gMap->setCenter($geocoded_address->getLat(), $geocoded_address->getLng());
Yii::import('ext.EGmap.*');

$gMap = new EGMap();
$gMap->setWidth(500);
$gMap->setHeight(400);
$gMap->zoom = 12;


// Center the map on geocoded address
// $gMap->setCenter($geocoded_address->getLat(), $geocoded_address->getLng());

$patient_address=$order['address'];
$geocoded_paddress = new EGMapGeocodedAddress($patient_address);
$geocoded_paddress->geocode($gMap->getGMapClient());
$gMap->setCenter($geocoded_paddress->getLat(), $geocoded_paddress->getLng());
/*


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
    $icon=new EGMapMarkerImage('http://nicknguyen.com/onpoint/images/openpatient.png');
    $gMap->addMarker(
        new EGMapMarker($geocoded_paddress->getLat(), $geocoded_paddress->getLng(),
            array('title' =>$order['name'],'icon'=>$icon))
    );
    $icon2=new EGMapMarkerImage('http://nicknguyen.com/onpoint/images/caricon.png');
    foreach($dri as $ti){
        $id=$ti['driver_id']; $de=User::model()->findbyPk($id); $name=$de->getFullName();
        $gMap->addMarker(
            new EGMapMarker($ti['lat'],$ti['lon'],
                array('title' =>$name,'icon'=>$icon2))
        );

    }

} */

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
    
        <p><?php if($order['status']=="open") { ?><a href="<?php $id=$order['id']; echo $this->createUrl('patient/cancelOrder',array('id'=>$id)); ?>" class="btn btn-danger">Cancel
        Order</a> <?php }else if($order['status']=="assigned"){ ?> Your Caregiver, <?php echo $order['drivername']; ?>
            is on
                the way!!
<?php } ?>

        <?php if($this->uniqueid =="dispatcher"){
            echo "<h4>Assign a Driver Below</h4>";
            echo "<ol id='selectable'>";
            foreach($dri as $t){

                $id=$t['driver_id'];
                $do=User::model()->findbyPk($id);
                $name=$do->getFullName();

                echo "<li id='$id'>$name</li>";


            }

            echo "</ol>";


            ?>
            <style>
                #feedback { font-size: 1.4em; }
                #selectable .ui-selecting { background: #FECA40; }
                #selectable .ui-selected { background: #F39814; color: white; }
                #selectable { list-style-type: none; margin: 0; padding: 0; width: 450px; }
                #selectable li { margin: 3px; padding: 1px; float: left; width: 100px; height: 80px; border:1px
                solid black;  text-align: center; }
            </style>
            <script>
                jQuery(function() {
                    jQuery( "#selectable" ).selectable();
                });
            </script>
        <?php   } ?>
    </div>
</div>


