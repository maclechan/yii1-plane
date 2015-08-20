<?php

/**
 * This is the model class for table "admin_user".
 *
 * The followings are the available columns in table 'admin_user':
 * @property integer $user_id
 * @property string $user_name
 * @property string $email
 * @property string $mobile
 * @property string $password
 * @property integer $add_time
 * @property integer $last_login
 * @property string $last_ip
 * @property integer $role_id
 * @property integer $status
 * @property integer $type
 * @property string $data_auth
 */
class AdminUser extends CActiveRecord
{
	public $groups;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminUser the static model class
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
		return 'admin_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name','required','message'=>'用户名必填！'),				 			
			array('user_name', 'unique', 'message'=>'此用户己存在，请重填一个！'),//用户名不能重复(与数据库比较)
			array('password','required','message'=>'密码必填！'),
			array('email', 'email', 'message'=>'邮箱格式不正确！'),//邮箱默认可以为空
			array('status', 'required', 'message'=>'必须要给员工一个状态！'),
			array('mobile', 'match','pattern'=>'/^1\d{10}$/','message'=>'手机号码格式不正确！'),//验证手机号码(都是数字，13开始，一共有11位)
			array('add_time, data_auth, role_id', 'required'),
			array('add_time, last_login, status, type', 'numerical', 'integerOnly'=>true),
			array('user_name, email', 'length', 'max'=>60),
			array('mobile', 'length', 'max'=>20),
			array('password', 'length', 'max'=>32),
			array('last_ip', 'length', 'max'=>15),
			array('data_auth', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, add_time, last_login, last_ip, role_id, type, data_auth', 'safe', 'on'=>'search'),
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
				'role' => array(self::HAS_ONE, "AdminUserRole", '', 'on'=>'t.role_id = role.role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'user_name' => '姓 名',
			'user_groups' => '所属组',
			'email' => '邮  箱',
			'mobile' => '手  机',
			'password' => '密  码',
			'add_time' => 'Add Time',
			'last_login' => 'Last Login',
			'last_ip' => 'Last Ip',
			'role_id' => 'Role',
			'status' => '状  态',
			'type' => '用户区域',
			'data_auth' => '数据权限',
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
		$criteria=new CDbCriteria(
				array(
						"with" => array('role'),
						//"condition" => "t.status=1",
				)
					
		);
		$criteria->compare('t.user_name',$this->user_name,true);
		$criteria->compare('t.type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function validatePassword($password)
	{
		return md5($password)===$this->password;
	}		
}