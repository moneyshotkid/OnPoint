<?php

/**
 * This is the model class for table "promotions".
 *
 * The followings are the available columns in table 'promotions':
 * @property integer $id
 * @property string $promotion
 * @property string $startdate
 * @property string $enddate
 * @property string $purchasetotal
 * @property integer $quantity
 * @property string $cost
 * @property string $inventory_id
 * @property string $grade
 * @property integer $count
 */
class Promotions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Promotions the static model class
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
		return 'promotions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('promotion, quantity, cost, inventory_id', 'required'),
			array('quantity, count', 'numerical', 'integerOnly'=>true),
			array('promotion', 'length', 'max'=>200),
			array('purchasetotal', 'length', 'max'=>10),
			array('cost', 'length', 'max'=>6),
			array('inventory_id', 'length', 'max'=>10),
			array('grade', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, promotion, startdate, enddate, purchasetotal, quantity, cost, inventory_id, grade, count', 'safe', 'on'=>'search'),
		);
	}

    public function getPromotions(){
       $sql="SELECT promotion from Promotions";
       return 	Yii::app()->db->createCommand($sql)->queryAll();
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
			'promotion' => 'Promotion',
			'startdate' => 'Date Promotion Begins',
			'enddate' => 'Date Promotion Ends',
			'purchasetotal' => 'Total Member Purchases',
			'quantity' => 'Weight Included in Promotion',
			'cost' => 'Discounted Cost of Promotion',
			'inventory_id' => 'Strains to include in promotion',
			'grade' => 'Grades in Promotion',
			'count' => 'Limit Promotion to number of sales',
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
		$criteria->compare('promotion',$this->promotion,true);
		$criteria->compare('startdate',$this->startdate,true);
		$criteria->compare('enddate',$this->enddate,true);
		$criteria->compare('purchasetotal',$this->purchasetotal,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('cost',$this->cost,true);
		$criteria->compare('inventory_id',$this->inventory_id,true);
		$criteria->compare('grade',$this->grade,true);
		$criteria->compare('count',$this->count);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}