<?php

/**
 * This is the model class for table "member_share_goods".
 *
 * The followings are the available columns in table 'member_share_goods':
 * @property string $id
 * @property integer $uid
 * @property integer $recom_id
 * @property integer $advi_id
 * @property integer $goods_id
 * @property string $openid
 * @property integer $add_time
 */
class MemberShareGoods extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemberShareGoods the static model class
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
		return 'member_share_goods';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, recom_id, advi_id, goods_id, openid, add_time', 'required'),
			array('uid, recom_id, advi_id, goods_id, add_time', 'numerical', 'integerOnly'=>true),
			array('openid', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, recom_id, advi_id, goods_id, openid, add_time', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'recom_id' => 'Recom',
			'advi_id' => 'Advi',
			'goods_id' => 'Goods',
			'openid' => 'Openid',
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('recom_id',$this->recom_id);
		$criteria->compare('advi_id',$this->advi_id);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('add_time',$this->add_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}