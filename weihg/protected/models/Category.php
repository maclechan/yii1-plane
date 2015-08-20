<?php

/**
 * This is the model class for table "customer_category".
 *
 * The followings are the available columns in table 'customer_category':
 * @property integer $c_id
 * @property string $c_name
 * @property string $add_man
 * @property integer $add_time
 * @property integer $status
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerCategory the static model class
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
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('c_name, add_man, add_time', 'required'),
			array('add_time, status', 'numerical', 'integerOnly'=>true),
			array('c_name', 'length', 'max'=>40),
			array('add_man', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('c_id, c_name, add_man, add_time, status', 'safe', 'on'=>'search'),
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
			'c_id' => 'C',
			'c_name' => 'C Name',
			'add_man' => 'Add Man',
			'add_time' => 'Add Time',
			'status' => 'Status',
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

		$criteria->compare('c_id',$this->c_id);
		$criteria->compare('c_name',$this->c_name,true);
		$criteria->compare('add_man',$this->add_man,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}