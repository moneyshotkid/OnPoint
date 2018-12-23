<?php

/**
 * This is the model class for table "mya_meth".
 *
 * The followings are the available columns in table 'mya_meth':
 * @property integer $id
 * @property string $cl_name
 * @property string $me_name
 * @property string $me_returns
 * @property string $me_description
 * @property string $me_definedby
 * @property string $me_access
 * @property string $me_link
 *
 * The followings are the available model relations:
 * @property DocClass $clName0
 */
class Meth extends EYiiApiActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Meth the static model class
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
		return 'mya_meth';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cl_name, me_name', 'required'),
			array('me_returns, me_description, me_definedby, me_access, me_link', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cl_name, me_name, me_returns, me_description, me_definedby, me_access, me_link', 'safe', 'on'=>'search'),
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
			'clName0' => array(self::BELONGS_TO, 'DocClass', 'cl_name'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cl_name' => 'Name',
			'me_name' => 'Name',
			'me_returns' => 'Returns',
			'me_description' => 'Description',
			'me_definedby' => 'Defined by',
			'me_access' => 'Access',
			'me_link' => 'Link',
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
		$criteria->compare('cl_name',$this->cl_name,true);
		$criteria->compare('me_name',$this->me_name,true);

        $criteria->order = "me_name ASC";
        return Meth::model()->findAll($criteria);
	}
}
