<?php 
/**
 * 婚礼倒计时
 * @time(2015-02-09)
 * @author [chan] <[429140141]>
 */
class TminusController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	/**
	 * 	初始化函数
	 */
	public function init(){
		$this->layout = 'application.views.layouts.main';
		//-----判断是否来自微信公众号
		if(isset($_GET['authid']) && $_GET['authid']){
			if(!Yii::app()->user->getState("openid")){
				Yii::app()->user->setState("openid",$_GET['authid']);
			}
		}else{
			if(!Yii::app()->user->getState("openid")){				
				echo '请关注微婚购公众账号';exit;
			}
		}		
	}

	public function actionTminuslist(){
		//$model = TminusCate::model()->with('tm')->findAll(array("offset"=>0,"limit"=>6));
		$model = TminusCate::model()->with('tm')->findAll();
		$this->render('tminuslist',array('model'=>$model));
	}
	//ajax加载请求倒计时文章
	public function actionTminusajaxl(){
		if($_POST['cid']){
			$cid = $_POST['cid'];
			//起始值0,5
			$page_index = isset($_POST['page_index'])?$_POST['page_index']:0;
			$start = $page_index*6; 
			$list = new Tminus();
			$data = $list->findAll(array("select"=>"id,cover,title,browse","condition"=>"cid=$cid","offset"=>$start,"limit"=>6,"order"=>"browse desc"));
			if($data){
				$list_data = array();
				$ii = 0;
				foreach($data as $v){
					$list_data[$ii]['param_1'] = $v->id; //ID号
					$list_data[$ii]['param_2'] = $v->cover; //封面
					$list_data[$ii]['param_3'] = $v->title; //标题
					$list_data[$ii]['param_4'] = $v->browse; //浏览量		
					$ii++;
				}
				echo CJSON::encode($list_data);
			}else{
				echo 1;//暂无数据
			}
		}else{
			echo 'request is error!';
		}
	}

	//婚礼倒计时文章详情页
	public function actionTminusatc(){
		if (isset($_GET['id']) && $_GET['id']) {
			$id = $_GET['id'];
			$model = Tminus::model()->findByPk("$id");
			$this -> render('tminusatc',array('model'=>$model));
		}
	}


}
 ?>