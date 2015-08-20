<?php

/**
 * This is the model class for table "goods_tag".
 *
 * The followings are the available columns in table 'goods_tag':
 * @property integer $tag_id
 * @property integer $cat_id
 * @property string $tag_name
 * @property integer $sort_order
 */
class GoodsTag extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GoodsTag the static model class
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
		return 'goods_tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_id, tag_name', 'required'),
			array('cat_id, sort_order', 'numerical', 'integerOnly'=>true),
			array('tag_name', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tag_id, cat_id, tag_name, sort_order', 'safe', 'on'=>'search'),
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
			"cate"=>array(self::HAS_ONE,"Category",'','on'=>'t.cat_id = cate.c_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tag_id' => 'Tag',
			'cat_id' => 'Cat',
			'tag_name' => 'Tag Name',
			'sort_order' => 'Sort Order',
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
		$criteria->with = array('cate');

		$criteria->compare('tag_id',$this->tag_id);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('tag_name',$this->tag_name,true);
		$criteria->compare('sort_order',$this->sort_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}