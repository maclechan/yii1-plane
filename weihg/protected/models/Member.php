<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property string $uid
 * @property string $uname
 * @property integer $sex
 * @property string $birthday
 * @property string $qq
 * @property string $weixin
 * @property string $mobile
 * @property string $email
 * @property string $icon
 * @property integer $score
 * @property string $login
 * @property string $reg_time
 * @property string $last_login_time
 * @property integer $status
 * @property string $openid
 * @property string $nmq
 */
class Member extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Member the static model class
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
		return 'member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('openid', 'required'),
			array('sex, score, status', 'numerical', 'integerOnly'=>true),
			array('uname, weixin, openid', 'length', 'max'=>100),
			array('qq, login, reg_time, last_login_time', 'length', 'max'=>10),
			array('mobile', 'length', 'max'=>20),
			array('email', 'length', 'max'=>50),
			array('icon, nmq', 'length', 'max'=>255),
			array('birthday', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, uname, sex, birthday, qq, weixin, mobile, email, icon, score, login, reg_time, last_login_time, status, openid, nmq', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'uname' => 'Uname',
			'sex' => 'Sex',
			'birthday' => 'Birthday',
			'qq' => 'Qq',
			'weixin' => 'Weixin',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'icon' => 'Icon',
			'score' => 'Score',
			'login' => 'Login',
			'reg_time' => 'Reg Time',
			'last_login_time' => 'Last Login Time',
			'status' => 'Status',
			'openid' => 'Openid',
			'nmq' => 'Nmq',
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

		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('uname',$this->uname,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('weixin',$this->weixin,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('score',$this->score);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('reg_time',$this->reg_time,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('nmq',$this->nmq,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}