<?php

/**
 * This is the model class for table "mya_proper".
 *
 * The followings are the available columns in table 'mya_proper':
 * @property integer $id
 * @property string $cl_name
 * @property string $pr_name
 * @property string $pr_type
 * @property string $pr_description
 * @property string $pr_definedby
 * @property string $pr_access
 * @property string $pr_link
 *
 * The followings are the available model relations:
 * @property DocClass $clName0
 */
class Proper extends EYiiApiActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Proper the static model class
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
		return 'mya_proper';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cl_name, pr_name', 'required'),
			array('pr_type, pr_description, pr_definedby, pr_access, pr_link', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cl_name, pr_name, pr_type, pr_description, pr_definedby, pr_access, pr_link', 'safe', 'on'=>'search'),
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
			'pr_name' => 'Name',
			'pr_type' => 'Type',
			'pr_description' => 'Description',
			'pr_definedby' => 'Defined by',
			'pr_access' => 'Access',
			'pr_link' => 'Link',
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
		$criteria->compare('pr_name',$this->pr_name,true);

        $criteria->order = "pr_name ASC";
        return Proper::model()->findAll($criteria);
	}
}
