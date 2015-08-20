<?php
/*
**@version 2015-02-12
**@author  yuzixiu
*/
class WhgController extends Controller
{
	/**
	 * 初始化
	 */
	public function init(){
		Yii::import('ext.wechat.Wechat',true);
		$this->layout = false;			
	}	
	/**
	 * 微婚购公众号
	 */	
	public function actionWhg(){
		$weObj = new Wechat($_GET);
        $weObj->token = 'whgwhg'; //填写你设定的key
        $weObj->appid = 'wx95f6bdf230047a68'; //填写高级调用功能的app id
        $weObj->appsecret = 'ffe1eb21c7976986caa9813ead47fab7'; //填写高级调用功能的密钥
		$weObj->debug = true;
        if (isset($_GET['echostr'])){
            $weObj->valid();
        }	
		
		$msgtype = $weObj->getRev()->getRevType(); //接受消息的类型
		$revfrom  = $weObj->getRevFrom(); //获取消息来源微信id
		Yii::app()->user->setState("openid",$revfrom);
		if($msgtype == 'event'){
			$evArr = $weObj->getRev()->getRevEvent();
			if($evArr['event'] == 'subscribe') {
				$newsData = array('0'=>array(
						'Title'=>'微婚购 www.weihungo.com',
						'Description'=>'微婚购是国内最便捷、最经济、最专业的结婚采购平台、并有海之声婚礼执行团队为您保驾护航。',
						'PicUrl'=>'http://lsg.qqjiehun.com/images/wechat/whgts.jpg',
						'Url'=>'http://weihungo.com/site/index/authid/'.$revfrom
				)
				);
				$weObj->news($newsData)->reply();
			}
		}else{
			if($msgtype == 'text' && $weObj->getRev()->getRevContent() == '测试'){
				$newsData = array('0'=>array(
						'Title'=>'微婚购1.0测试',
						'PicUrl'=>'http://lsg.qqjiehun.com/images/wechat/whgts.jpg',
						'Url'=>'http://weihungo.com/site/index/authid/'.$revfrom
				));			
			}else{
				$newsData = array('0'=>array(
						'Title'=>'微婚购 www.weihungo.com',
						'Description'=>'微婚购是国内最便捷、最经济、最专业的结婚采购平台、并有海之声婚礼执行团队为您保驾护航。',
						'PicUrl'=>'http://lsg.qqjiehun.com/images/wechat/whgts.jpg',
						'Url'=>'http://weihungo.com/site/index/authid/'.$revfrom
				)
				);
			}
			$weObj->news($newsData)->reply();
		}
		
	}
 	
 	
 	
}