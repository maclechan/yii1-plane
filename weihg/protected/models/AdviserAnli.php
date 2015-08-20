<?php

/**
 * This is the model class for table "adviser_anli".
 *
 * The followings are the available columns in table 'adviser_anli':
 * @property string $id
 * @property integer $advi_id
 * @property string $advi_name
 * @property string $cover
 * @property string $title
 * @property string $desc
 * @property integer $zans
 * @property integer $shares
 * @property integer $add_time
 * @property integer $upd_time
 */
class AdviserAnli extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdviserAnli the static model class
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
		return 'adviser_anli';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title','required','message'=>' 案例名不能少'),
			array('cover','required','message'=>' 请上传案例封面图'),
			array('advi_id, advi_name, cover, title, desc', 'required'),
			array('advi_id, zans, shares, add_time, upd_time', 'numerical', 'integerOnly'=>true),
			array('advi_name', 'length', 'max'=>60),
			array('cover, title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, advi_id, advi_name, desc, zans, shares, add_time, upd_time', 'safe', 'on'=>'search'),
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
			'advi_id' => '顾问id',
			'advi_name' => '顾问姓名',
			'cover' => '案例封面',
			'title' => '案例名称',
			'desc' => '案例详情',
			'zans' => '点赞数',
			'shares'=> '分享数',
			'add_time' => '添加时间',
			'upd_time' => '更新时间',
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
		$criteria->compare('advi_id',$this->advi_id);
		$criteria->compare('advi_name',$this->advi_name,true);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('zans',$this->zans);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('upd_time',$this->upd_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}