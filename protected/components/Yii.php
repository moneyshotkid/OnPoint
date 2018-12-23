<?php
$yii2path = '/wamp/yii2/framework';
require($yii2path . '/BaseYii.php'); // Yii 2.x

$yii1path = '/wamp/framework';
require($yii1path . '/YiiBase.php'); // Yii 1.x

class Yii extends \yii\BaseYii
{
    // copy-paste the code from YiiBase (1.x) here
}

Yii::$classMap = include($yii2path . '/classes.php');
// register Yii2 autoloader via Yii1
Yii::registerAutoloader(['Yii', 'autoload']);
// create the dependency injection container
Yii::$container = new yii\di\Container;
?>