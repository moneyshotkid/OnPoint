<?php

class Strains extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'strains';
	}

	public function rules()
	{
		return array(
			array('strain, category, dominant, image, description', 'required'),
			array('strain', 'length', 'max'=>200),
			array('category, dominant', 'length', 'max'=>6),
			array('image', 'length', 'max'=>150),
			array('description', 'length', 'max'=>250),
			array('id, strain, category, dominant, image, description', 'safe', 'on'=>'search'),
		);
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
			'id' => Yii::t('app', 'ID'),
			'strain' => Yii::t('app', 'Strain'),
			'category' => Yii::t('app', 'Category'),
			'dominant' => Yii::t('app', 'Dominant'),
			'image' => Yii::t('app', 'Image'),
			'description' => Yii::t('app', 'Description'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('strain',$this->strain,true);

		$criteria->compare('category',$this->category,true);

		$criteria->compare('dominant',$this->dominant,true);

		$criteria->compare('image',$this->image,true);

		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
