<?php

class Patient extends CActiveRecord
{


    public $arrDrivers=array("driver_id"=>0,"lastcheckin"=>0,"lat"=>0,"lon"=>0,"distance"=>0,"notified"=>false,
"confirmed"=>"",
        "ETA"=>0);
    public $assignedDriver="";
    public $lat=0;
    public $lon=0;




    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'patient';
	}


    public function loadDrivers($arrCaregivers)
    {
     foreach($arrCaregivers as $driver){
         $this->arrDrivers['driver_id']=$driver->id;
         $this->arrDrivers['lat']=$driver->lat;
         $this->arrDrivers['lon']=$driver->lon;
         $this->arrDrivers['lastcheckin']=$driver->lastcheckin;

     }
}






	public function rules()
	{
		return array(
		array('name, address, email,zip, phone, condition', 'required'),
			array('zip', 'numerical', 'integerOnly'=>true),
			array('name,  patientlicense', 'length', 'max'=>200),
			array('address', 'length', 'max'=>300),
			array('phone', 'length', 'max'=>15),
			array('condition', 'length', 'max'=>150),
			array('licenseNumber', 'length', 'max'=>100),
			array('driverslicense', 'length', 'max'=>100),
			array('id, name, address, zip, phone, condition, licenseNumber, recFile,dlCopy,driverslicense,
			patientlicense, notes, expiration', 'safe', 'on'=>'search,create,update'),
		);
	}

	public function relations()
	{
		return array(
		      'user' => array(self::BELONGS_TO, 'User', 'id'),
            'sales' => array(self::HAS_MANY, 'Sales', 'patient_id'),
		);
	}
    /**
     *
     */
    protected function beforeSave()
    {
        if ($this->isNewRecord)
        {

            $this->city = geolookup::model()->findCity($this->zip);
            $this->addressverified = 0;


        }else {

            $this->expiration = date('Y-m-d');
        }
        return CActiveRecord::beforeSave();
    }


    public function updateFiles($id,$filesarray){





    }
    public function getConditionOptions(){
        return array(
            'ADD/ADHD'=>'ADD/ADHD',
            'ALS'=>'ALS',
            'ALZHEIMER'=>'ALZHEIMER',
            'ANOREXIA'=>'ANOREXIA',
            'ANXIETY'=>'ANXIETY',
            'ARTHRITIS'=>'ARTHRITIS',
            'ATROPHY BLANCHE'=>'ATROPHY BLANCHE',
            'AUTISM'=>'AUTISM',
            'BLOOD PRESSURE'=>'BLOOD PRESSURE',
            'BRAIN CANCER (GILOMA)'=>'BRAIN CANCER (GILOMA)',
            'BREAST CANCER'=>'BREAST CANCER',
            'CANCER '=>'CANCER',
            'CANCER BRAIN'=>'CANCER BRAIN',
            'CANCER BREAST'=>'CANCER BREAST',
            'CANCER COLORECTAL'=>'CANCER COLORECTAL',
            'CANCER LUKEMIA'=>'CANCER LUKEMIA',
            'CANCER LUNG'=>'CANCER LUNG',
            'CANCER PANCREATIC'=>'CANCER PANCREATIC',
            'CANCER PROSTATE'=>'CANCER PROSTATE',
            'CANCER SKIN'=>'CANCER SKIN',
            'CANCER TESTICULAR'=>'CANCER TESTICULAR',
            'CHEMOTHERAPY PATIENT'=>'CHEMOTHERAPY PATIENT',
            'COLORECTAL CANCER'=>'COLORECTAL CANCER',
            'DEMENTIA'=>'DEMENTIA',
            'EPIPEPSY/SEIZURES'=>'EPIPEPSY/SEIZURES',
            'FIBROMYALGIA'=>'FIBROMYALGIA',
            'GLAUCOMA'=>'GLAUCOMA',
            'HEART DISEASE'=>'HEART DISEASE',
            'HIV/AIDS'=>'HIV/AIDS',
            'INFLAMMATION'=>'INFLAMMATION',
            'INSOMNIA'=>'INSOMNIA',
            'LUKEMIA'=>'LUKEMIA',
            'LUNG CANCER'=>'LUNG CANCER',
            'LUPUS'=>'LUPUS',
            'MENTAL DISORDER'=>'MENTAL DISORDER',
            'MIGRAINE'=>'MIGRAINE',
            'MULTIPLE SCLEROSIS'=>'MULTIPLE SCLEROSIS',
            'NEUROPATHIC PAIN'=>'NEUROPATHIC PAIN',
            'OSTEOPOROSIS'=>'OSTEOPOROSIS',
            'PAIN'=>'PAIN',
            'PANCREATIC CANCER'=>'PANCREATIC CANCER',
            'PARKINSONS'=>'PARKINSONS',
            'PROSTATE CANCER'=>'PROSTATE CANCER',
            'RHEUMATISM'=>'RHEUMATISM',
            'SKIN CANCER'=>'SKIN CANCER',
            'SLEEP DISORDER'=>'SLEEP DISORDER',
            'TESTICULAR CANCER'=>'TESTICULAR CANCER',
            'TOURETTE’S SYNDROM'=>'TOURETTE’S SYNDROM',
            'TRAUMATIC STRESS'=>'TRAUMATIC STRESS',

        );
    }

   


	public function behaviors()
	{
	    return array(
        'activerecord-relation'=>array(
            'class'=>'ext.yiiext.behaviors.activerecord-relation.EActiveRecordRelationBehavior')
    );
	}

  /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'zip' => 'Zip',
            'phone' => 'Phone',
            'condition' => 'Condition',
            'licenseNumber' => 'License Number',
            'driverslicense' => 'Drivers license Number',
            'patientlicense' => 'Patient license Number',
             'dlCopy' => 'Drivers License Image',
            'recFile' => 'Patient Recommendation Image',
            'notes' => 'Internal Notes',
            'expiration' => 'Medicinal Recommendation Expiration',

        );
    }


 /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('zip',$this->zip);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('condition',$this->condition,true);

        $criteria->compare('dlCopy',$this->dlCopy,true);
        $criteria->compare('recFile',$this->recFile,true);
        $criteria->compare('licenseNumber',$this->licenseNumber,true);
        $criteria->compare('driverslicense',$this->driverslicense,true);
        $criteria->compare('patientlicense',$this->patientlicense,true);
        $criteria->compare('notes',$this->notes,true);
        $criteria->compare('expiration',$this->expiration,true);


        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
}
