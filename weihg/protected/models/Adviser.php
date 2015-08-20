<?php

/**
 * This is the model class for table "adviser".
 *
 * The followings are the available columns in table 'adviser':
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property string $intro
 * @property string $icon
 * @property integer $level
 * @property integer $job
 * @property integer $style
 * @property integer $sex
 * @property string $mobile
 * @property string $phone
 * @property string $weixin
 * @property string $qq
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $address
 * @property integer $work_exp
 * @property integer $garees
 * @property integer $price_fw
 * @property integer $anlis
 * @property integer $zans
 * @property integer $add_id
 * @property integer $add_time
 * @property integer $upd_time
 * @property integer $status
 */
class Adviser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Adviser the static model class
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
		return 'adviser';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name','required','message'=>' 在此留名！'),
			array('mobile','required','message'=>'留个手机号呗！'),
			array('icon','required','message'=>' 求露脸！'),
			array('mobile', 'match','pattern'=>'/^1\d{10}$/','message'=>' 你不乖哦,乱输手机号！'),
			array('weixin','required','message'=>' 留个微信呗'),
			array('level, job, style, sex, mobile, work_exp, garees, price_fw, anlis, zans, add_id, add_time, upd_time, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			array('password', 'length', 'max'=>32),
			array('intro, icon, weixin, address', 'length', 'max'=>255),
			array('phone, qq', 'length', 'max'=>20),
			array('province, city, area', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, password, intro, level, job, style, sex, phone, qq, province, city, area, address, work_exp, garees, price_fw, anlis, zans, add_id, add_time, upd_time, status', 'safe', 'on'=>'search'),
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
			"anli"=>array(self::HAS_MANY,"AdviserAnli",'','on'=>'t.id = anli.advi_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '顾问姓名',
			'password' => '密码',
			'intro' => '顾问简介',
			'icon' => '头像',
			'level' => '顾问等级',
			'job' => '职责',
			'style' => '风格',
			'sex' => '性别',
			'mobile' => '手机',
			'phone' => '电话',
			'weixin' => '微信',
			'qq' => 'QQ',
			'province' => '省',
			'city' => '市',
			'area' => '区',
			'address' => '具体地址',
			'work_exp' => '从业经验',
			'garees' => '场次数',
			'price_fw' => '服务价格区间',
			'anlis' => '案例数',
			'zans' => '点赞数',
			'add_id' => '录入人id',
			'add_time' => '录入时间',
			'upd_time' => '更新时间',
			'status' => '状态',
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
		$criteria->compare('name',$this->name,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function validatePassword($password)
	{
		return md5($password)===$this->password;
	}
}