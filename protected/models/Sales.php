<?php

class Sales extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'sales';
	}

	public function rules()
	{
		return array(
			array('patient_id,order_id', 'required'),
			array('id, patient_id, quantity, employee_id', 'numerical', 'integerOnly'=>true),
			array('total', 'length', 'max'=>9),
			array('paymentType', 'length', 'max'=>200),
			array('id, patient_id, quantity, date, employee_id, total, paymentType', 'safe',
                'on'=>'search'),
		);
	}


    protected function beforeSave()
    {
        if ($this->isNewRecord)
        {

            $this->date=new CDbExpression('NOW()');


        }else {
            $this->date=new CDbExpression('NOW()');

        }
        return CActiveRecord::beforeSave();
    }




	public function getPaymentOptions()
{
return array(
'creditcard' => 'Credit Card',
'Cash' => 'Cash',
'Check' => 'Check',
);
}

	public function getQuantityOptions()
{
return array(
'1' => 'Gram',
'2' => '2 Grams',
'3.5' => 'Eigth',
'4'=>'4 Grams',
'7' => 'Quarter',
'8'=>'8 Grams',

);
}
    public function getStatus()
    {
        return array(
            'pending' => 'Pending',
            'assigned' => 'Assigned',
            'closed' => 'closed',
            'canceled'=>'Canceled',

        );
    }


    public function sales($driverid){

        $sql="Select
   k11.lh_users.username,
   k11.sales.quantity,
  k11.sales.order_id,
  k11.sales.date,
  k11.sales.total,
  k11.sales.paymentType,
  k11.sales.patient_id,
  k11.patient.name,
  k11.patient.address,
  k11.patient.city,
  k11.patient.zip,
  k11.patient.email,
  k11.patient.phone,
  k11.patient.`condition`,
  k11.patient.expiration,
  k11.patient.notes
From
  k11.lh_users Inner Join
  k11.sales On k11.sales.employee_id = k11.lh_users.id Inner Join
  k11.patient On k11.sales.patient_id = k11.patient.id
Where
  k11.lh_users.role = 'driver' And
  k11.lh_users.id = $driverid";
        $drivers = Yii::app()->db->createCommand($sql)->queryAll();
        return $drivers;
    }

	public function relations()
	{
		return array(
			'items' => array(self::HAS_MANY, 'Item', 'sales_id'),
			//'id0' => array(self::BELONGS_TO, 'Item', 'id'),
			'employee' => array(self::BELONGS_TO, 'User', 'employee_id'),
			'patient' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
				'order' => array(self::BELONGS_TO, 'Orders', 'id'),
		);
	}

	public function behaviors()
	{

	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'patient_id' => Yii::t('app', 'Patient'),
			'quantity' => Yii::t('app', 'Quantity'),
			'date' => Yii::t('app', 'Donation Date'),
			'employee_id' => Yii::t('app', 'Employee'),
			'total' => Yii::t('app', 'Total'),
			'paymentType' => Yii::t('app', 'Payment Type'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
				$criteria->compare('order_id',$this->order_id);
		$criteria->compare('patient_id',$this->patient_id);

		$criteria->compare('quantity',$this->quantity);

		$criteria->compare('date',$this->date,true);

		$criteria->compare('employee_id',$this->employee_id);

		$criteria->compare('total',$this->total,true);

		$criteria->compare('paymentType',$this->paymentType,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
