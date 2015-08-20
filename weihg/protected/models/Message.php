<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $id
 * @property integer $sender_id
 * @property integer $recever_id
 * @property string $title
 * @property string $content
 * @property integer $send_time
 * @property integer $send_status
 * @property integer $receve_status
 * @property integer $read_status
 */
class Message extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Message the static model class
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
		return 'message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender_id, recever_id, title, send_time', 'required'),
			array('sender_id, recever_id, send_time, send_status, receve_status, read_status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sender_id, recever_id, title, content, send_time, send_status, receve_status, read_status', 'safe', 'on'=>'search'),
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
				"ms"=>array(self::HAS_ONE,"AdminUser",'','on'=>'ms.user_id = t.sender_id'),
				"mr"=>array(self::HAS_ONE,"AdminUser",'','on'=>'mr.user_id = t.recever_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sender_id' => 'Sender',
			'recever_id' => 'Recever',
			'title' => 'Title',
			'content' => 'Content',
			'send_time' => 'Send Time',
			'send_status' => 'Send Status',
			'receve_status' => 'Receve Status',
			'read_status' => 'Read Status',
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

		$criteria=new CDbCriteria(array('with'=>array('ms','mr'),'order'=>'t.send_time desc'));

	//	$criteria->compare('id',$this->id);
		$criteria->compare('t.sender_id',$this->sender_id);
		$criteria->compare('t.recever_id',$this->recever_id);
		$criteria->compare('t.title',$this->title,true);
	//	$criteria->compare('content',$this->content,true);
	//	$criteria->compare('send_time',$this->send_time);
		$criteria->compare('send_status',$this->send_status);
		$criteria->compare('receve_status',$this->receve_status);
	//	$criteria->compare('read_status',$this->read_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}