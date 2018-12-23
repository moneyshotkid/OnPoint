<?php

class expenses extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    protected function beforeSave(){
        if(parent::beforeSave()){
                $this->date = date('Y-m-d');
                return true;
        }
        return false;
}


	public function tableName()
	{
		return 'expenses';
	}

	public function rules()
	{
		return array(
			array('date, expense, amount', 'required'),
			array('recurring', 'numerical', 'integerOnly'=>true),
			array('amount, paymentMethod, monthly', 'length', 'max'=>6),
			array('id, date, expense, amount, paymentMethod, timestamp, recurring, monthly', 'safe', 'on'=>'search'),
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
			'date' => Yii::t('app', 'Date'),
			'expense' => Yii::t('app', 'Expense'),
			'amount' => Yii::t('app', 'Amount'),
			'paymentMethod' => Yii::t('app', 'Payment Method'),
			'timestamp' => Yii::t('app', 'Timestamp'),
			'recurring' => Yii::t('app', 'Recurring'),
			'monthly' => Yii::t('app', 'Monthly'),
		);
	}

    	public function getPaymentOptions()
{
return array(
'cash' => 'Cash',
'credit' => 'Credit Card',
'check' => 'Check',
);
}


	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('date',$this->date,true);

		$criteria->compare('expense',$this->expense,true);

		$criteria->compare('amount',$this->amount,true);

		$criteria->compare('paymentMethod',$this->paymentMethod,true);

		$criteria->compare('timestamp',$this->timestamp,true);

		$criteria->compare('recurring',$this->recurring);

		$criteria->compare('monthly',$this->monthly,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
