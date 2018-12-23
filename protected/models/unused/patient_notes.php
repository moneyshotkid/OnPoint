<?php

class patient_notes extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'patient_notes';
	}

	public function rules()
	{
		return array(
			array('user_id, patient_id, note', 'required'),
			array('user_id, patient_id', 'numerical', 'integerOnly'=>true),
			array('note', 'length', 'max'=>250),
			array('type', 'length', 'max'=>7),
			array('id, date, user_id, patient_id, note, type', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'patient' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function behaviors()
	{
		return array('CAdvancedArBehavior',    'DateTimeZoneAndFormatBehavior' => 'application.components.DateTimeZoneAndFormatBehavior',
				array('class' => 'ext.CAdvancedArBehavior')
				);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'date' => Yii::t('app', 'Date'),
			'user_id' => Yii::t('app', 'User'),
			'patient_id' => Yii::t('app', 'Patient'),
			'note' => Yii::t('app', 'Note'),
			'type' => Yii::t('app', 'Type'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('date',$this->date,true);

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('patient_id',$this->patient_id);

		$criteria->compare('note',$this->note,true);

		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
