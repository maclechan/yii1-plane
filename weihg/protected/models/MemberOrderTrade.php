<?php

/**
 * This is the model class for table "member_order_trade".
 *
 * The followings are the available columns in table 'member_order_trade':
 * @property string $id
 * @property string $order_id
 * @property string $trans_id
 * @property string $bank_type
 * @property string $bank_billno
 * @property integer $total_fee
 * @property string $time_end
 * @property string $open_id
 */
class MemberOrderTrade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemberOrderTrade the static model class
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
		return 'member_order_trade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, trans_id, bank_type, total_fee, time_end, open_id', 'required'),
			array('total_fee', 'numerical', 'integerOnly'=>true),
			array('order_id, bank_billno', 'length', 'max'=>32),
			array('trans_id', 'length', 'max'=>28),
			array('bank_type', 'length', 'max'=>16),
			array('time_end', 'length', 'max'=>14),
			array('open_id', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, trans_id, bank_type, bank_billno, total_fee, time_end, open_id', 'safe', 'on'=>'search'),
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
			'order_id' => 'Order',
			'trans_id' => 'Trans',
			'bank_type' => 'Bank Type',
			'bank_billno' => 'Bank Billno',
			'total_fee' => 'Total Fee',
			'time_end' => 'Time End',
			'open_id' => 'Open',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('trans_id',$this->trans_id,true);
		$criteria->compare('bank_type',$this->bank_type,true);
		$criteria->compare('bank_billno',$this->bank_billno,true);
		$criteria->compare('total_fee',$this->total_fee);
		$criteria->compare('time_end',$this->time_end,true);
		$criteria->compare('open_id',$this->open_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}