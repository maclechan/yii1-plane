<?php

/**
 * This is the model class for table "assoc_cy".
 *
 * The followings are the available columns in table 'assoc_cy':
 * @property string $id
 * @property integer $ass_id
 * @property string $cy_name
 * @property string $cy_logo
 * @property integer $add_time
 */
class AssocCy extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AssocCy the static model class
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
		return 'assoc_cy';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ass_id, cy_name, cy_logo, add_time', 'required'),
			array('ass_id, add_time', 'numerical', 'integerOnly'=>true),
			array('cy_name', 'length', 'max'=>60),
			array('cy_logo', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ass_id, cy_name, cy_logo, add_time', 'safe', 'on'=>'search'),
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
			'ass_id' => 'Ass',
			'cy_name' => '协会成员名称',
			'cy_logo' => '协会logo',
			'add_time' => 'Add Time',
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
		$criteria->compare('ass_id',$this->ass_id);
		$criteria->compare('cy_name',$this->cy_name,true);
		$criteria->compare('cy_logo',$this->cy_logo,true);
		$criteria->compare('add_time',$this->add_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}