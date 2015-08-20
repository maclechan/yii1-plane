<?php

/**
 * This is the model class for table "member_fav_anli".
 *
 * The followings are the available columns in table 'member_fav_anli':
 * @property string $id
 * @property integer $uid
 * @property integer $anli_id
 * @property integer $advi_id
 * @property integer $add_time
 */
class MemberFavAnli extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemberFavAnli the static model class
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
		return 'member_fav_anli';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, anli_id, advi_id, add_time', 'required'),
			array('uid, anli_id, advi_id, add_time', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, anli_id, advi_id, add_time', 'safe', 'on'=>'search'),
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
			"anli"=>array(self::HAS_ONE,"AdviserAnli",'','on'=>'t.anli_id = anli.id'),
			"advi"=>array(self::HAS_ONE,"Adviser",'','on'=>'t.advi_id = advi.id'),
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
			'anli_id' => 'Anli',
			'advi_id' => 'Advi',
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
		$criteria->compare('anli_id',$this->anli_id);
		$criteria->compare('advi_id',$this->advi_id);
		$criteria->compare('add_time',$this->add_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}