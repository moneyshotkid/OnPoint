<?php
 
/**
 * Behavior for Timzone change and time format change. 
 * This behaviour change all date / datetime /and timestamp from db (which in EST5EDT Time zone) to Asia/Calcutta time zone and convert format to d-m-Y H:i:s / d-m-Y
 * while saving it will convert Asia/Calcutta to EST5EDT time zone and format to Y-m-d H:i:s / Y-m-d.
 * @package Component 
 * @author Smithesh (Steve) - smithesh.1986@gmail.com
 * INTEGRATION
 * ------------
 * In config/main.php
 * 'timeZone'=>'Asia/Calcutta', //my local time zone
 * 
 * Palce this file in protected/components
 * 
 * call behaviour in mobel by including following
 *   public function behaviors() {
  return array(
  'ActiveRecordDateformatBehavior' => 'application.components.ActiveRecordDateformatBehavior',
  );
  }
 */
class DateTimeZoneAndFormatBehavior extends CActiveRecordBehavior {
 
    public $user_timezone = "America/Los_Angeles";
    public $edtTimeZone = "GMT";
    public $php_user_short_date = 'd-m-Y';
    public $php_user_time = 'H:i:s';
    public $php_user_datetime = 'd-m-Y H:i:s';
    public $php_db_date = 'Y-m-d';
    public $php_db_time = 'H:i:s';
    public $php_db_datetime = 'Y-m-d H:i:s';
 
    public function beforeSave($event) {
 
 
 
        foreach ($event->sender->tableSchema->columns as $columnName => $column) {
            if ($event->sender->$columnName) {
                if ($column->dbType == 'date') {
                    if ($event->sender->$columnName != "0000-00-00") { //checking date field with no value
                        $col_data = date("d-m-Y", strtotime($event->sender->$columnName));
                        $datetime_object = DateTime::createFromFormat($this->php_user_short_date, $col_data, new DateTimeZone($this->user_timezone));
                        $event->sender->$columnName = $datetime_object->format($this->php_db_date);
                    }
                } else if ($column->dbType == 'datetime' || $column->dbType == 'timestamp') {
                    if ($event->sender->$columnName != '0000-00-00 00:00:00') { //checking field with no value
                        if ($event->sender->$columnName == "NOW()") {
                            $event->sender->$columnName = date("Y-m-d H:i:s");
                        }
                        $col_data = date("d-m-Y H:i:s", strtotime($event->sender->$columnName));
                        $datetime_object = DateTime::createFromFormat($this->php_user_datetime, $col_data, new DateTimeZone($this->user_timezone));
                        $datetime_object->setTimeZone(new
                                DateTimeZone($$this->edtTimeZone));
                        $event->sender->$columnName =
                                $datetime_object->format($this->php_db_datetime);
                    }
                } else if ($column->dbType == 'time') {
                    $datetime_object = DateTime::createFromFormat($this->php_user_time, $event->sender->$columnName, new DateTimeZone($this->user_timezone));
                    $datetime_object->setTimeZone(new DateTimeZone($this->edtTimeZone));
                    $event->sender->$columnName = $datetime_object->format($this->php_db_time);
                }
            }
        }
        return parent::beforeSave($event);
    }
 
    public function afterFind($event) {
        foreach ($event->sender->tableSchema->columns as $columnName => $column) {
            if (($column->dbType == 'date') ||
                    ($column->dbType == 'time') ||
                    ($column->dbType == 'timestamp') ||
                    ($column->dbType == 'datetime')) {
                $datetime_object = new DateTime($event->sender->$columnName, new DateTimeZone($this->edtTimeZone));
                if ($column->dbType == 'date') {
                    if (date("Y-m-d", strtotime($event->sender->$columnName)) != "1970-01-01") {
                        if ($event->sender->$columnName != '0000-00-00') {
                            $event->sender->$columnName =
                                    $datetime_object->format(
                                    $this->php_user_short_date);
                        }
                    }
                } elseif ($column->dbType == 'datetime' || $column->dbType == 'timestamp') {
                    if (date("Y-m-d", strtotime($event->sender->$columnName)) != "1970-01-01") {
                        if ($event->sender->$columnName != '0000-00-00 00:00:00') {
                            $datetime_object->setTimeZone(new
                                    DateTimeZone($this->user_timezone));
                            $event->sender->$columnName =
                                    $datetime_object->format(
                                    $this->php_user_datetime);
                        }
                    }
                } else if ($column->dbType == 'time') {
                    $datetime_object->setTimeZone(new
                            DateTimeZone($this->user_timezone));
                    /* Output the required format */
                    $event->sender->$columnName =
                            $datetime_object->format($this->php_user_time);
                }
            }
        }
        return parent::afterFind($event);
    }
 
 
}
 
?>