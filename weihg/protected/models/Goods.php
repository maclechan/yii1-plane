<?php

/**
 * This is the model class for table "goods".
 *
 * The followings are the available columns in table 'goods':
 * @property integer $goods_id
 * @property integer $c_id
 * @property string $goods_name
 * @property string $bs_name
 * @property string $bs_location
 * @property integer $tag_id
 * @property string $goods_intro
 * @property string $price
 * @property string $shop_price
 * @property string $goods_img
 * @property string $goods_thumb
 * @property string $goods_desc
 * @property integer $last_update
 * @property integer $add_time
 * @property integer $add_id
 * @property integer $zans
 * @property integer $sales
 * @property integer $shares
 * @property integer $status
 */
class Goods extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Goods the static model class
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
		return 'goods';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('c_id, goods_name, price, shop_price, goods_img, goods_desc, add_id', 'required'),
			array('c_id, tag_id, last_update, add_time, add_id, zans, sales, shares, status', 'numerical', 'integerOnly'=>true),
			array('goods_name, bs_name, bs_location, goods_intro, goods_img, goods_thumb', 'length', 'max'=>255),
			array('price, shop_price', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('goods_id, c_id, goods_name, bs_name, bs_location, tag_id, goods_intro, price, shop_price, goods_img, goods_thumb, goods_desc, last_update, add_time, add_id, zans, sales, shares, status', 'safe', 'on'=>'search'),
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
			"gc"=>array(self::HAS_ONE,"Category",'','on'=>'t.c_id = gc.c_id'),
			"gtg"=>array(self::HAS_ONE,"GoodsTag",'','on'=>'t.tag_id = gtg.tag_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'goods_id' => 'Goods',
			'c_id' => 'C',
			'goods_name' => 'Goods Name',
			'bs_name' => 'Bs Name',
			'bs_location' => 'Bs Location',
			'tag_id' => 'Tag',
			'goods_intro' => 'Goods Intro',
			'price' => 'Price',
			'shop_price' => 'Shop Price',
			'goods_img' => 'Goods Img',
			'goods_thumb' => 'Goods Thumb',
			'goods_desc' => 'Goods Desc',
			'last_update' => 'Last Update',
			'add_time' => 'Add Time',
			'add_id' => 'Add',
			'zans' => 'Zans',
			'sales' => 'Sales',
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
		$criteria->with=array('gc');
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('t.c_id',$this->c_id);
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('bs_name',$this->bs_name,true);
		$criteria->compare('bs_location',$this->bs_location,true);
		$criteria->compare('tag_id',$this->tag_id);
		$criteria->compare('goods_intro',$this->goods_intro,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('shop_price',$this->shop_price,true);
		$criteria->compare('goods_img',$this->goods_img,true);
		$criteria->compare('goods_thumb',$this->goods_thumb,true);
		$criteria->compare('goods_desc',$this->goods_desc,true);
		$criteria->compare('last_update',$this->last_update);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('add_id',$this->add_id);
		$criteria->compare('zans',$this->zans);
		$criteria->compare('sales',$this->sales);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}