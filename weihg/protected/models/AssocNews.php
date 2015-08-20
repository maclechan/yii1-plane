<?php

/**
 * This is the model class for table "assoc_news".
 *
 * The followings are the available columns in table 'assoc_news':
 * @property string $id
 * @property integer $ass_id
 * @property string $title
 * @property string $pic
 * @property string $content
 * @property integer $add_time
 * @property integer $type
 */
class AssocNews extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AssocNews the static model class
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
		return 'assoc_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ass_id, title, pic, content, add_time', 'required'),
			array('ass_id, add_time, type', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('pic', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ass_id,  title, pic, content, add_time, type', 'safe', 'on'=>'search'),
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
			'ass_id' => 'Ass',
			'title' => '标题',
			'pic' => '封面图片',
			'content' => '内容',
			'add_time' => 'Add Time',
			'type' => '活动类别',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}