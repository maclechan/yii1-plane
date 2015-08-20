<?php

/**
 * This is the model class for table "tminus_cate".
 *
 * The followings are the available columns in table 'tminus_cate':
 * @property integer $id
 * @property string $cname
 * @property string $cword
 * @property string $tminus
 */
class TminusCate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TminusCate the static model class
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
		return 'tminus_cate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cname','required','message'=>' 模块标题必填'),
			array('cname, cword, tminus', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cword, tminus', 'safe', 'on'=>'search'),
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
			"tm"=>array(self::HAS_ONE,"Tminus",'','on'=>'t.id = tm.cid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cname' => 'Cname',
			'cword' => 'Cword',
			'tminus' => 'Tminus',
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
		$criteria->compare('cname',$this->cname,true);
		$criteria->compare('cword',$this->cword,true);
		$criteria->compare('tminus',$this->tminus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}