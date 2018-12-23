<?php

class driverbalancesheet extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'driverbalancesheet';
	}

	public function rules()
	{
		return array(
			array('user_id, manager_id, date', 'required'),
			array('user_id, manager_id', 'numerical', 'integerOnly'=>true),
			array('paid, owed', 'length', 'max'=>8),
			array('id, user_id, manager_id, date, paid, owed', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'manager' => array(self::BELONGS_TO, 'User', 'manager_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function behaviors()
	{
		return array('CAdvancedArBehavior',  'DateTimeZoneAndFormatBehavior' => 'application.components.DateTimeZoneAndFormatBehavior',
				array('class' => 'ext.CAdvancedArBehavior')
				);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'user_id' => Yii::t('app', 'User'),
			'manager_id' => Yii::t('app', 'Manager'),
			'date' => Yii::t('app', 'Date'),
			'paid' => Yii::t('app', 'Paid'),
			'owed' => Yii::t('app', 'Owed'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('manager_id',$this->manager_id);

		$criteria->compare('date',$this->date,true);

		$criteria->compare('paid',$this->paid,true);

		$criteria->compare('owed',$this->owed,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
