<?php

/**
 * This is the model class for table "action".
 *
 * The followings are the available columns in table 'action':
 * @property integer $id
 * @property integer $m_id
 * @property integer $nav_id
 * @property string $default_ctl
 * @property string $action_cn
 * @property string $action_en
 * @property string $action_belonging
 * @property integer $status
 * @property integer $sort
 */
class Action extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Action the static model class
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
		return 'action';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('m_id, nav_id, default_ctl, action_cn, action_en', 'required'),
			array('m_id, nav_id, status, sort', 'numerical', 'integerOnly'=>true),
			array('default_ctl, action_cn, action_en', 'length', 'max'=>40),
			array('action_belonging', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, m_id, nav_id, default_ctl, action_cn, action_en, action_belonging, status, sort', 'safe', 'on'=>'search'),
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
			"nav"=>array(self::HAS_ONE,"Nav",'','on'=>'nav.id = t.nav_id and nav.status=1'),
			"md"=>array(self::HAS_ONE,"Menu",'','on'=>'md.id = t.m_id and md.status=1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'm_id' => 'M',
			'nav_id' => 'Nav',
			'default_ctl' => 'Default Ctl',
			'action_cn' => 'Action Cn',
			'action_en' => 'Action En',
			'action_belonging' => 'Action Belonging',
			'status' => 'Status',
			'sort' => 'Sort',
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
		$criteria->with=array('md','nav');
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.m_id',$this->m_id);
	//	$criteria->compare('nav_id',$this->nav_id);
	//	$criteria->compare('default_ctl',$this->default_ctl,true);
	//	$criteria->compare('action_cn',$this->action_cn,true);
	//	$criteria->compare('action_en',$this->action_en,true);
	//	$criteria->compare('status',$this->status);
	//	$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}