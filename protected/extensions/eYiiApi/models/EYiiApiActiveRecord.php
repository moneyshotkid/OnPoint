<?php
/**
 * Custome ActiveRecord to alter the database to the 
 * yiiapi database.
 * 
 * @since 0.3
 * @author Dimitrios Mengidis
 **/
class EYiiApiActiveRecord extends CActiveRecord
{
    public function getDbConnection()
    {
        $myiiapidb = new CDbConnection('sqlite:'.dirname(__FILE__).'/../data/myiiapi.sqlite');
        $myiiapidb->active = true;
        return $myiiapidb;
    }
}
