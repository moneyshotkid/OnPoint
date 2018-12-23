<?php

class Item extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'item';
	}

	public function rules()
	{
		return array(
			array('sales_id, inventory_id, quantity, cost,systemcost', 'required'),
			array('sales_id, inventory_id, quantity', 'numerical', 'integerOnly'=>true),
			array('cost', 'length', 'max'=>9),
			array('id, sales_id, inventory_id, quantity, cost', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'inventory' => array(self::BELONGS_TO, 'Inventory', 'inventory_id'),
			'sales' => array(self::HAS_ONE, 'Sales', 'id'),
		);
	}
/*
    public function onBeforeSave(){
    //If there is deduct the amount from quantity
$Inventory=Inventory::model()->findByPk($this->inventory_id);
        //Check to make sure theres enough in inventory
if($Inventory->currentweight < $this->quantity){
   CModelEvent::isValid(false) ;
}else{

    $updatedInventory=$this->quantity - $Inventory->currentweight;
    $Inventory->currentweight=$updatedInventory;
$Inventory->save();
}

}
*/
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
			'sales_id' => Yii::t('app', 'Sales'),
			'inventory_id' => Yii::t('app', 'Inventory'),
			'quantity' => Yii::t('app', 'Quantity'),
			'cost' => Yii::t('app', 'Cost'),
					'systemcost' => Yii::t('app', 'System Cost'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('sales_id',$this->sales_id);

		$criteria->compare('inventory_id',$this->inventory_id);

		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('systemcost',$this->systemcost);
		$criteria->compare('cost',$this->cost,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
