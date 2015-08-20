<?php

/**
 * This is the model class for table "Notice".
 *
 * The followings are the available columns in table 'Notice':
 * @property integer $id
 * @property integer $type
 * @property string $title
 * @property string $content
 * @property string $sender
 * @property integer $time
 */
class Notice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notice the static model class
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
		return 'notice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, title, sender, time', 'required'),
			array('type, time', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>20),
			array('sender', 'length', 'max'=>60),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, title, content, sender, time', 'safe', 'on'=>'search'),
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
				"na"=>array(self::HAS_ONE,"AdminUser",'','on'=>'na.user_id = t.sender'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'title' => 'Title',
			'content' => 'Content',
			'sender' => 'Sender',
			'time' => 'Time',
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

		$criteria=new CDbCriteria(array('with'=>'na','order'=>'t.time desc'));

	//	$criteria->compare('id',$this->id);
	//	$criteria->compare('type',$this->type);
		$criteria->compare('t.title',$this->title,true);
	//	$criteria->compare('content',$this->content,true);
	//	$criteria->compare('sender',$this->sender,true);
	//	$criteria->compare('time',$this->time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}