<?php
/**
 * Created by Nick Nguyen
 * User: Nick
 * Date: 3/6/2015
 * Time: 5:26 PM
 */

class Distance {

    private $_patient=array();
    private $_drivers=array();
    public $drivers



    //Assuming 45 mph
    public function getETA($miles,$speed=45){
        if($miles>$speed){ return false; }
        $rawtime=$miles/$speed;
        return round($rawtime * 100);
    }

    public function allDrivers(){
    $drivers = User::model()->findAll("role=:role AND driverstatus=:status",array(':role'=>'driver',':status'=>1));

}


}