<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property string $id
 * @property integer $user_id
 * @property integer $goods_id
 * @property string $goods_c
 * @property integer $adviser_id
 * @property string $adviser_c
 * @property integer $service
 * @property integer $skill
 * @property integer $guide
 * @property string $ip
 * @property string $add_time
 */
class Comments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comments the static model class
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
		return 'comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, goods_id, adviser_id, ip', 'required'),
			array('user_id, goods_id, adviser_id, service, skill, guide', 'numerical', 'integerOnly'=>true),
			array('goods_c, adviser_c', 'length', 'max'=>500),
			array('ip', 'length', 'max'=>100),
			array('add_time', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, goods_id, goods_c, adviser_id, adviser_c, service, skill, guide, ip, add_time', 'safe', 'on'=>'search'),
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
			"mem"=>array(self::HAS_ONE,"Member",'','on'=>'t.user_id = mem.uid'),
			"cimg"=>array(self::HAS_MANY,"CommentsImg",'','on'=>'t.id = cimg.comments_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'goods_id' => 'Goods',
			'goods_c' => 'Goods C',
			'adviser_id' => 'Adviser',
			'adviser_c' => 'Adviser C',
			'service' => 'Service',
			'skill' => 'Skill',
			'guide' => 'Guide',
			'ip' => 'Ip',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('goods_c',$this->goods_c,true);
		$criteria->compare('adviser_id',$this->adviser_id);
		$criteria->compare('adviser_c',$this->adviser_c,true);
		$criteria->compare('service',$this->service);
		$criteria->compare('skill',$this->skill);
		$criteria->compare('guide',$this->guide);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('add_time',$this->add_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}