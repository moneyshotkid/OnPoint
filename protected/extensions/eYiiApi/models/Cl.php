<?php

/**
 * This is the model class for table "mya_cl".
 *
 * The followings are the available columns in table 'mya_cl':
 * @property integer $id
 * @property string $cl_name
 * @property string $cl_package
 * @property string $cl_inheritance
 * @property string $cl_subclasses
 * @property string $cl_since
 * @property string $cl_version
 * @property string $cl_description
 * @property string $cl_link
 */
class Cl extends EYiiApiActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cl the static model class
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
		return 'mya_cl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cl_name', 'required'),
			array('cl_package, cl_inheritance, cl_subclasses, cl_since, cl_version, cl_description, cl_link', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cl_name, cl_package, cl_inheritance, cl_subclasses, cl_since, cl_version, cl_description, cl_link', 'safe', 'on'=>'search'),
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
			'cl_package' => 'Package',
			'cl_inheritance' => 'Inheritance',
			'cl_subclasses' => 'Subclasses',
			'cl_since' => 'Since',
			'cl_version' => 'Version',
			'cl_description' => 'Description',
			'cl_link' => 'Link',
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
		/**$criteria->compare('cl_package',$this->cl_package,true);
		$criteria->compare('cl_inheritance',$this->cl_inheritance,true);
		$criteria->compare('cl_subclasses',$this->cl_subclasses,true);
		$criteria->compare('cl_since',$this->cl_since,true);
		$criteria->compare('cl_version',$this->cl_version,true);
		$criteria->compare('cl_description',$this->cl_description,true);
		$criteria->compare('cl_link',$this->cl_link,true);**/

/**		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));**/
        $criteria->order = "cl_name ASC";
        return Cl::model()->findAll($criteria);

	}
}
