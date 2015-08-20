<?php

/**
 * This is the model class for table "member_order".
 *
 * The followings are the available columns in table 'member_order':
 * @property string $id
 * @property string $order_id
 * @property integer $uid
 * @property string $re_name
 * @property string $re_mobile
 * @property string $re_location
 * @property string $remark
 * @property string $goods_name
 * @property string $goods_img
 * @property integer $advi_id
 * @property string $advi_name
 * @property integer $recom_id
 * @property integer $goods_id
 * @property string $price
 * @property integer $rows
 * @property integer $add_time
 * @property integer $status
 */
class MemberOrder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemberOrder the static model class
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
		return 'member_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, uid, re_name, re_mobile, re_location, goods_name, goods_img, advi_id, advi_name, recom_id, goods_id, price, add_time', 'required'),
			array('uid, advi_id, recom_id, goods_id, rows, add_time, status', 'numerical', 'integerOnly'=>true),
			array('order_id', 'length', 'max'=>32),
			array('re_name, re_mobile, price', 'length', 'max'=>20),
			array('re_location, remark, goods_name, goods_img', 'length', 'max'=>255),
			array('advi_name', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, uid, re_name, re_mobile, re_location, remark, goods_name, goods_img, advi_id, advi_name, recom_id, goods_id, price, rows, add_time, status', 'safe', 'on'=>'search'),
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
			"odadvi"=>array(self::HAS_ONE,"Adviser",'','on'=>'t.advi_id = odadvi.id','select'=>'icon,mobile,qq,name,anlis,zans'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => 'Order',
			'uid' => 'Uid',
			're_name' => 'Re Name',
			're_mobile' => 'Re Mobile',
			're_location' => 'Re Location',
			'remark' => 'Remark',
			'goods_name' => 'Goods Name',
			'goods_img' => 'Goods Img',
			'advi_id' => 'Advi',
			'advi_name' => 'Advi Name',
			'recom_id' => 'Recom',
			'goods_id' => 'Goods',
			'price' => 'Price',
			'rows' => 'Rows',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('re_name',$this->re_name,true);
		$criteria->compare('re_mobile',$this->re_mobile,true);
		$criteria->compare('re_location',$this->re_location,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('goods_img',$this->goods_img,true);
		$criteria->compare('advi_id',$this->advi_id);
		$criteria->compare('advi_name',$this->advi_name,true);
		$criteria->compare('recom_id',$this->recom_id);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('rows',$this->rows);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}