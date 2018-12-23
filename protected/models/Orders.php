<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property integer $driver_id
 * @property integer $patient_id
 * @property integer $sales_id
 * @property string $requestedStrains
 * @property string $Timein
 * @property string $PrefDeliveryTime
 * @property string $status
 * @property string $patientnote
 *
 * The followings are the available model relations:
 * @property Sales $sales
 * @property Users $driver
 * @property Patient $patient
 */
class Orders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id', 'required'),
			array('driver_id, patient_id', 'numerical', 'integerOnly'=>true),
			array('requestedStrains, patientnote', 'length', 'max'=>250),
			array('status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, driver_id, patient_id, requestedStrains, Timein, PrefDeliveryTime, status, patientnote', 'safe', 'on'=>'search'),
		);
	}

	
	
		public function getStatus()
{
return array(
'open' => 'Open',
'assigned' => 'Assigned',
'closed' => 'closed',
'canceled'=>'Canceled',
);
}
    public function behaviors() {

    }
    /**
     *
     */
    protected function beforeSave()
    {
        if ($this->isNewRecord)
        {

            $this->PrefDeliveryTime=date('H:i');



        }


        return CActiveRecord::beforeSave();
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		//	'sales' => array(self::BELONGS_TO, 'Sales', 'sales_id'),
			'driver' => array(self::BELONGS_TO, 'User', 'driver_id'),
			'patient' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
		);
	}


    public function scopes()
    {
        return array(
            'open'=>array(
                'condition'=>'status=open',
            ),
            'assigned'=>array(
                'condition'=>'status=assigned',
            ),
            'closed'=>array(
                'condition'=>'status=closed',
            ),
            'canceled'=>array(
                'condition'=>'status=canceled',
            ),


        );
    }

    public function driver($driver_id)
    {
        $this->getDbCriteria()->mergeWith(
            array(
                'condition'=>'driver_id='.(int)$driver_id

            )
        );
        return $this;
    }

    public function patient($id)
    {
        $this->getDbCriteria()->mergeWith(
            array(
                'condition'=>'patient_id='.$id

            )
        );
        return $this;
    }


    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'driver_id' => 'Driver',
			'patient_id' => 'Patient',
			'requestedStrains' => 'Requested Strains',
			'Timein' => 'Order Placed On',
			'PrefDeliveryTime' => 'Requested Delivery Time',
			'status' => 'Order Status',
			'patientnote' => 'Note to Driver',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('driver_id',$this->driver_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('requestedStrains',$this->requestedStrains,true);
		$criteria->compare('Timein',$this->Timein,true);
		$criteria->compare('PrefDeliveryTime',$this->PrefDeliveryTime,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('patientnote',$this->patientnote,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
