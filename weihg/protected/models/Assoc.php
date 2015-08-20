<?php

/**
 * This is the model class for table "assoc".
 *
 * The followings are the available columns in table 'assoc':
 * @property string $id
 * @property string $loger
 * @property string $icon
 * @property string $password
 * @property string $assoc_name
 * @property string $assoc_desc
 * @property string $assocer
 * @property string $mobile
 * @property string $qq
 * @property string $mail
 * @property string $assocer_jy
 * @property integer $add_time
 */
class Assoc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Assoc the static model class
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
		return 'assoc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('loger, icon, password, assoc_name, assoc_desc, assocer, mobile, assocer_jy, add_time', 'required'),
			array('add_time', 'numerical', 'integerOnly'=>true),
			array('loger, assoc_name, assocer, mail', 'length', 'max'=>60),
			array('icon, assocer_jy', 'length', 'max'=>255),
			array('password', 'length', 'max'=>32),
			array('mobile', 'length', 'max'=>11),
			array('qq', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, loger, icon, password, assoc_name, assoc_desc, assocer, mobile, qq, mail, assocer_jy, add_time', 'safe', 'on'=>'search'),
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
			'loger' => '协会登录名',
			'icon' => '会长图片',
			'password' => '密码',
			'assoc_name' => '协会名称',
			'assoc_desc' => '协会简介',
			'assocer' => '会长名称',
			'mobile' => '手机',
			'qq' => 'qq',
			'mail' => '邮件',
			'assocer_jy' => '会长寄语',
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
		$criteria->compare('loger',$this->loger,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('assoc_name',$this->assoc_name,true);
		$criteria->compare('assoc_desc',$this->assoc_desc,true);
		$criteria->compare('assocer',$this->assocer,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('assocer_jy',$this->assocer_jy,true);
		$criteria->compare('add_time',$this->add_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function validatePassword($password)
	{
		return md5($password)===$this->password;
	}	
}