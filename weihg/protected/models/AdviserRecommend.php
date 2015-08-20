<?php

/**
 * This is the model class for table "adviser_recommend".
 *
 * The followings are the available columns in table 'adviser_recommend':
 * @property string $id
 * @property integer $advi_id
 * @property integer $goods_id
 * @property string $advi_name
 * @property string $recommend_reason
 * @property integer $add_time
 * @property integer $upd_time
 * @property integer $status
 */
class AdviserRecommend extends CActiveRecord
{
	public $cid;
	public $goodsname;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdviserRecommend the static model class
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
		return 'adviser_recommend';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goods_id','required','message'=>' 被推荐的产品ID必须存在'),
			array('advi_id, goods_id, advi_name, recommend_reason', 'required'),
			array('advi_id, goods_id, add_time, upd_time, status', 'numerical', 'integerOnly'=>true),
			array('advi_name, recommend_reason', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, advi_id, advi_name, recommend_reason, add_time, upd_time, status', 'safe', 'on'=>'search'),
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
			"gds"=>array(self::HAS_ONE,"Goods",'','on'=>'t.goods_id = gds.goods_id','select'=>'goods_name,price,shop_price,goods_img,bs_name,bs_location,goods_desc,zans,shares'),
			"gdsam"=>array(self::HAS_ONE,"Goods",'','on'=>'t.goods_id = gdsam.goods_id'),
			"gdscate"=>array(self::HAS_ONE,"Category",'','on'=>'gdsam.c_id = gdscate.c_id'),
			"fav"=>array(self::HAS_ONE,"MemberFavGoods",'','on'=>'fav.recom_id = t.id and fav.uid='.Yii::app()->user->getState("uid"))
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'advi_id' => 'Advi',
			'goods_id' => 'Goods',
			'recommend_reason' => 'Recommend Reason',
			'advi_name' => '顾问姓名',
			'add_time' => 'Add Time',
			'upd_time' => 'Upd Time',
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
		$criteria->with=array('gdsam','gdscate');

		$criteria->compare('id',$this->id,true);
		$criteria->compare('advi_id',$this->advi_id);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('gdsam.c_id',$this->cid);
		$criteria->compare('gdsam.goods_name',$this->goodsname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}