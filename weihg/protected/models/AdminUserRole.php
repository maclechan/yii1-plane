<?php

/**
 * This is the model class for table "admin_user_role".
 *
 * The followings are the available columns in table 'admin_user_role':
 * @property integer $role_id
 * @property string $role_name
 * @property string $intro
 * @property integer $add_id
 * @property string $add_man
 * @property string $role_menu
 * @property string $role_nav
 * @property string $role_action
 * @property integer $add_time
 * @property integer $status
 */
class AdminUserRole extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminUserRole the static model class
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
		return 'admin_user_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_name, add_id, add_man, add_time', 'required'),
			array('add_id, add_time, status', 'numerical', 'integerOnly'=>true),
			array('role_name, add_man', 'length', 'max'=>60),
			array('intro, role_menu, role_nav', 'length', 'max'=>255),
			array('role_action', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('role_id, role_name, intro, add_id, add_man, role_menu, role_nav, role_action, add_time, status', 'safe', 'on'=>'search'),
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
			'role_id' => 'Role',
			'role_name' => 'Role Name',
			'intro' => 'Intro',
			'add_id' => 'Add',
			'add_man' => 'Add Man',
			'role_menu' => 'Role Menu',
			'role_nav' => 'Role Nav',
			'role_action' => 'Role Action',
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

		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('role_name',$this->role_name,true);
		$criteria->compare('intro',$this->intro,true);
		$criteria->compare('add_id',$this->add_id);
		$criteria->compare('add_man',$this->add_man,true);
		$criteria->compare('role_menu',$this->role_menu,true);
		$criteria->compare('role_nav',$this->role_nav,true);
		$criteria->compare('role_action',$this->role_action,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}