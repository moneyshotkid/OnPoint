<?php

class Inventory extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'inventory';
	}

	public function rules()
	{
		return array(
			array('strain, type, weightrecieved,grade,  cost, currentweight, daterecieved, paymentstatus, employee_id', 'required'),
			array(' vendor_id, employee_id', 'numerical', 'integerOnly'=>true),
			array('strain', 'length', 'max'=>500),
			array('cost', 'length', 'max'=>8),
			array('paymentstatus', 'length', 'max'=>50),
			array('id, strain,grade, weightrecieved, vendor_id, cost, dlCopy,operationalmargin,cpg,twograms,eigth,
			fourgrams,productprice currentweight,
			daterecieved, duedate, description,thumbImage,mainImage,
			paymentstatus, employee_id', 'safe'),
		);
	}
	
		public function scopes()
    {
        return array(
            'paid'=>array(
                'condition'=>'paymentstatus=paid',
            ),
			'Sativa'=>array(
                'condition'=>'type=Sativa',
            ),
						'Indica'=>array(
                'condition'=>'type=Indica',
            ),
					'Hybrid'=>array(
                'condition'=>'type=Hybrid',
            ),
                  'instock'=>array(
                'condition'=>'currentweight>0',
            ),
            'owed'=>array(
                'condition'=>'paymentstatus=owed',
            ),
            'firesale'=>array(
                'condition'=>'duedate >'.new CDbExpression('NOW()'),
            ),
			
        );
    }
	
	
	
	
		public function getTypeOptions()
{
return array(
'Indica' => 'Indica',
'Sativa' => 'Sativa',
'Hybrid' => 'Hybrid',
    'Shatter' => 'Shatter',
    'Crumble' => 'Crumble',
    'Edibles' => 'Edibles',
    'Oils' => 'Oils',
'Other'=>'Other',
);
}
	
	
	public function getPaymentStatusOptions()
{
return array(
'paid' => 'paid',
'owed' => 'owed',
);
}


    	public function getQualityGradeOptions()
{
return array(
'A' => 'Private Reserve',
'B' => 'Top Shelf',
    'C' => 'Mid Grade',
'D' => 'Low Grade',
    'F' => 'MexiPressed',
);
}

	public function relations()
	{
		return array(
			'vendor' => array(self::BELONGS_TO, 'Vendor', 'vendor_id'),
			'employee' => array(self::BELONGS_TO, 'User', 'employee_id'),
			'items' => array(self::HAS_MANY, 'Item', 'inventory_id'),
		);
	}

	public function behaviors()
	{
		return array('CAdvancedArBehavior',    'DateTimeZoneAndFormatBehavior' => 'application.components.DateTimeZoneAndFormatBehavior',
				array('class' => 'ext.CAdvancedArBehavior')
				);
	}
protected function beforeSave(){
        if(parent::beforeSave()){
                $this->daterecieved = date('Y-m-d');
                $this->duedate = date('Y-m-d');
                return true;
        }
        return false;
}
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'strain' => Yii::t('app', 'Strain Name'),
				'type' => Yii::t('app', 'Strain Type'),
            	'grade' => Yii::t('app', 'Quality Grade'),
			'weightrecieved' => Yii::t('app', 'Amount Recieved'),
			'vendor_id' => Yii::t('app', 'Vendor'),
			'cost' => Yii::t('app', 'Cost to Cultivate'),
            		'operationalmargin' => Yii::t('app', 'Operational Adj'),
            'productprice' => Yii::t('app', 'Price'),
            		'cpg' => Yii::t('app', 'Gram'),
            'twograms' => Yii::t('app', '1/4'),
            'eigth' => Yii::t('app', '1/8'),
            'fourgrams' => Yii::t('app', '1/2'),
			'currentweight' => Yii::t('app', 'Amount Remaining'),
			'daterecieved' => Yii::t('app', 'Date Acquired'),
			'duedate' => Yii::t('app', 'Date to Pay Vendor'),
			'paymentstatus' => Yii::t('app', 'Current Payment Status'),
						'thumbimage' => Yii::t('app', 'Thumbnail Image'),
			'mainImage' => Yii::t('app', 'Main Image'),
			'description' => Yii::t('app', 'Description'),
			'tags' => Yii::t('app', 'Tags'),
			'employee_id' => Yii::t('app', 'Issuing Member'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('strain',$this->strain,true);
				$criteria->compare('type',$this->type,true);
        $criteria->compare('grade',$this->grade,true);

		$criteria->compare('weightrecieved',$this->weightrecieved);

		$criteria->compare('vendor_id',$this->vendor_id);

		$criteria->compare('cost',$this->cost,true);
        $criteria->compare('operationalmargin',$this->operationalmargin);
        $criteria->compare('productprice',$this->productprice,true);
	$criteria->compare('cpg',$this->cpg,true);
        	$criteria->compare('twograms',$this->twograms,true);
        	$criteria->compare('eigth',$this->eigth);
        	$criteria->compare('fourgrams',$this->fourgrams);
		$criteria->compare('currentweight',$this->currentweight);

		$criteria->compare('daterecieved',$this->daterecieved,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('duedate',$this->duedate,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('paymentstatus',$this->paymentstatus,true);

		$criteria->compare('employee_id',$this->employee_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
