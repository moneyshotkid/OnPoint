<?php

/**
 * This is the model class for table "vendor".
 *
 * The followings are the available columns in table 'vendor':
 * @property integer $id
 * @property string $company
 * @property string $address
 * @property integer $zip
 * @property string $phone
 * @property string $email
 * @property string $representative
 * @property integer $approved
 * @property string $notes
 *
 * The followings are the available model relations:
 * @property Inventory[] $inventories
 * @property Users $id0
 */
class Vendor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Vendor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vendor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company, phone', 'required'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company, phone', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'inventories' => array(self::HAS_MANY, 'Inventory', 'vendor_id'),
			'id0' => array(self::BELONGS_TO, 'Users', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company' => 'Company',

			'phone' => 'Phone',

			'approved' => 'Approved',
			'notes' => 'Notes',
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
		$criteria->compare('company',$this->company,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('approved',$this->approved);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}