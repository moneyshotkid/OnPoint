<?php

class geolookup extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'geolookup';
	}

	public function rules()
	{
		return array(
			array('LATITUDE, LONGITUDE, CITY, STATE, COUNTY, ZIP_CLASS', 'required'),
			array('ZIP', 'length', 'max'=>5),
			array('LATITUDE, LONGITUDE, COUNTY', 'length', 'max'=>15),
			array('CITY', 'length', 'max'=>30),
			array('STATE', 'length', 'max'=>2),
			array('ZIP_CLASS', 'length', 'max'=>20),
			array('ZIP, LATITUDE, LONGITUDE, CITY, STATE, COUNTY, ZIP_CLASS', 'safe', 'on'=>'search'),
		);
	}


    public function findCity($zip)
    {
        $criteria=array(
            'select'=>'CITY',
            'condition'=>'ZIP=' .$zip,
            'limit'=>1,
        );
      $d= $this->find($criteria);
        return $d->CITY;
    }




    public function relations()
	{
		return array(
		);
	}

	public function behaviors()
	{
		return array('CAdvancedArBehavior',
				array('class' => 'ext.CAdvancedArBehavior')
				);
	}

	public function attributeLabels()
	{
		return array(
			'ZIP' => Yii::t('app', 'Zip'),
			'LATITUDE' => Yii::t('app', 'Latitude'),
			'LONGITUDE' => Yii::t('app', 'Longitude'),
			'CITY' => Yii::t('app', 'City'),
			'STATE' => Yii::t('app', 'State'),
			'COUNTY' => Yii::t('app', 'County'),
			'ZIP_CLASS' => Yii::t('app', 'Zip Class'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('ZIP',$this->ZIP,true);

		$criteria->compare('LATITUDE',$this->LATITUDE,true);

		$criteria->compare('LONGITUDE',$this->LONGITUDE,true);

		$criteria->compare('CITY',$this->CITY,true);

		$criteria->compare('STATE',$this->STATE,true);

		$criteria->compare('COUNTY',$this->COUNTY,true);

		$criteria->compare('ZIP_CLASS',$this->ZIP_CLASS,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
