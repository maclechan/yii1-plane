<?php

/**
 * This is the model class for table "tminus".
 *
 * The followings are the available columns in table 'tminus':
 * @property string $id
 * @property integer $cid
 * @property string $title
 * @property string $intro
 * @property string $cover
 * @property string $desc
 * @property integer $browse
 * @property integer $like
 * @property string $pubtime
 * @property string $editime
 */
class Tminus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tminus the static model class
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
		return 'tminus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cid', 'required'),
			array('title','required','message'=>' 标题必不可少！'),
			array('cover','required','message'=>' 缩略图必不可少！'),
			array('cid, browse, like', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>64),
			array('intro, cover', 'length', 'max'=>255),
			array('pubtime, editime', 'length', 'max'=>11),
			array('desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cid, intro, desc, browse, like, pubtime, editime', 'safe', 'on'=>'search'),
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
			'cid' => '版块ID',
			'title' => '文章标题',
			'intro' => '文章简介',
			'cover' => '封面图',
			'desc' => '内容详情',
			'browse' => '浏览次数',
			'like' => '点赞数',
			'pubtime' => 'Pubtime',
			'editime' => 'Editime',
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
		$criteria->compare('cid',$this->cid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('intro',$this->intro,true);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('browse',$this->browse);
		$criteria->compare('like',$this->like);
		$criteria->compare('pubtime',$this->pubtime,true);
		$criteria->compare('editime',$this->editime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}