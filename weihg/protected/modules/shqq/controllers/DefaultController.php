<?php

class DefaultController extends Controller
{
	public function init(){
		$this->layout = false;//'application.modules.hilife.views.layouts.hilife';
	}
	public function actionIndex()
	{
		//会长风采
		$huiz = Assoc::model()->findAll(array(
			'limit' => 10
		));
		//婚礼主持
		$zhuci = Adviser::model()->findAll(array(
			'condition' => "job=1",
			'limit' => 10
		));
		//婚礼策划师
		$cehua = Adviser::model()->findAll(array(
			'condition' => "job=2",
			'limit' => 10
		));

		$this->render('index',array(
				"huiz"=>$huiz,
				"zhuci"=>$zhuci,
				"cehua"=>$cehua,
		));
	}

	//司仪个人主页
	public function actionPerson($id){
		$model = Adviser::model()->find("id=$id");
		$anli = AdviserAnli::model()->findAll("advi_id=$id");
		$this->render('person',array(
				"model"=>$model,
				"anli"=>$anli,
		));
	}

	//会长个人主页
	public function actionHperson($id){
		$model = Assoc::model()->find("id=$id");
		$member = AssocCy::model()->findAll("ass_id=$id");
		//协会热门活动
		$hdong = AssocNews::model()->findAll("ass_id=$id and type=2");
		//会展风采
		$fcai = AssocNews::model()->findAll("ass_id=$id and type=1");
		$this->render('hperson',array(
				"model"=>$model,
				"member"=>$member,
				"hdong" => $hdong,
				"fcai" => $fcai
		));
	}
	//会长里面详情页
	public function actionHpdetail($id){
		$xq = AssocNews::model()->find("id=$id");
		$this->render("hpersond",array(
				"xq"=>$xq,
		));
	}

	//案例详情页
	public function actionPdetail($id){
		$anli = AdviserAnli::model()->find("id=$id");
		$this->render("persond",array(
				"anli"=>$anli,
		));
	}
}