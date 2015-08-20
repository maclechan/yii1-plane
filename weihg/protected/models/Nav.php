<?php

/**
 * This is the model class for table "nav".
 *
 * The followings are the available columns in table 'nav':
 * @property integer $id
 * @property integer $m_id
 * @property string $nav_cn
 * @property integer $status
 * @property integer $sort
 */
class Nav extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Nav the static model class
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
		return 'nav';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('m_id, nav_cn', 'required'),
			array('m_id, status, sort', 'numerical', 'integerOnly'=>true),
			array('nav_cn', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, m_id, nav_cn, status, sort', 'safe', 'on'=>'search'),
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
			"ac_site"=>array(self::HAS_MANY,"Action",'','on'=>'t.id = ac_site.nav_id and ac_site.status=1'),
			"ac"=>array(self::HAS_MANY,"Action",'','on'=>'nav.id = ac.nav_id and ac.status=1'),
			"md"=>array(self::HAS_ONE,"Menu",'','on'=>'t.m_id = md.id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'm_id' => 'M',
			'nav_cn' => 'Nav Cn',
			'status' => 'Status',
			'sort' => 'Sort',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('m_id',$this->m_id);
		$criteria->compare('nav_cn',$this->nav_cn,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}