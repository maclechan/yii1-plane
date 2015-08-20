<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/system/adlist.css">
<div class="g-load"></div>
<div class="g-mask"></div><!-- 点击区域选择时，蒙版，当用户点击蒙版部分，隐藏掉选项 -->
<div class="g-body">
	<div class="g-head fs11 fc04 bg05">
		<div class="m-area f-fl f-tac">
			<span id="cur-area" class="m-areaT" onclick="changeArea()">浙江</span>
			<div class="m-select bg07">
				<span>上海</span>
				<span>江苏</span>
			</div>
		</div>
		<!-- back  隐藏 -->
		<div class="m-back f-fl f-tac">
			<span class="goback"></span>
		</div>
		<div class="m-inbox f-fl">
			<div class="m-input">
				<input id="inputT" class="fs08 fc06 bg04" type="text" onchange="showclose()">
			</div>
			<p id="filttl" class="f-tac">筛选</p>
		</div>
		<div id="filter" class="m-fit f-fr f-tac">筛选</div>
		
		<!-- search  隐藏 -->
		<div id="search" class="m-sch f-fr f-tac">搜索</div>
		<!-- 完成 -->
		<button id="m-done" class="bg05 f-fr f-tac"></button>
		
		<div class="f-cb"></div>
	</div>
	<!-- 关闭按钮 -->
	<div id="closebtn" class="fs10 bg06 f-cb f-tac fc02 br03">×</div>

	<!-- 筛选条件层 -->
	<div class="g-filt">
		
			<div class="box"></div>
			<div class="m-slt">
				<div id="styttl" class="sttl f-fl f-tal fs11 fc05 bg06">婚礼风格</div>
				<div id="stycnt" class="scnt f-fl fs08 fc07 bg06">
					<span id="sty1" mval="9">中式</span>
					<span id="sty2" mval="10">西式</span>
					<span id="sty3" mval="11">庄重</span>
					<span id="sty4" mval="12">复古</span>
					<span id="sty5" mval="5">清新</span>
					<span id="sty6" mval="6">浪漫</span>
					<span id="sty7" mval="7">童话</span>
					<span id="sty8" mval="8">唯美</span>
					<span id="sty9" mval="1">个性</span>
					<span id="sty10" mval="2">时尚</span>
					<span id="sty11" mval="3">奢华</span>
					<span id="sty12" mval="4">草坪</span>
				</div>
			</div>
			<div class="m-slt">
				<div id="sexttl" class="sttl f-fl  f-tal fs11 fc05 bg06">性别</div>
				<div id="sexcnt" class="scnt f-fl fs08 fc07 bg06">
					<span id="male" mval="1">男</span>
					<span id="fmale" mval="2">女</span>
				</div>
			</div>
			<div class="m-slt">
				<div id="clattl" class="sttl f-fl  f-tal fs11 fc05 bg06">职称</div>
				<div id="clacnt" class="scnt f-fl fs08 fc07 bg06">
					<span id="cla1" mval="1">初级</span>
					<span id="cla2" mval="2">中级</span>
					<span id="cla3" mval="3">高级</span>
				</div>
			</div>
			<div class="m-slt">
				<div id="costttl" class="sttl f-fl  f-tal fs11 fc05 bg06">婚礼预算</div>
				<div id="costcnt" class="scnt f-fl fs08 fc07 bg06">
					<span id="cost1" mval="1">800~1500</span>
					<span id="cost2" mval="2">1500~3000</span>
					<span id="cost3" mval="3">3000~5000</span>
					<span id="cost4" mval="4">5000~8000</span>
					<span id="cost5" mval="5">8000~10000</span>
					<span id="cost6" mval="6">10000以上</span>
				</div>
			</div>
		
	</div>
	<div class="g-list">
		<?php foreach($guwdata as $val){?>
		<a class="m-per bg06" href="<?php echo $this->createUrl('guwhome',array("id"=>$val->id));?>">
			<div class="m-list">
				<img class="f-fl" src="<?php echo $val->icon?>">
				<div class="m-info f-fl">
					<p class="m-intr"><span class="pname fs08 fc05"><?php echo $val->name?></span><span class="pttl  f-tac fs07 fc06">特级婚礼顾问</span></p>
					<p class="m-intr fs07 fc06"><span class="pname">作品:<span><?php echo $val->anlis?></span></span><span class="pttl f-tac">粉丝:<span><?php echo $val->zans?></span></span></p>
				</div>
			</div>
		</a>
		<?php  }?>
		
	</div>
	<!-- 加载更多 -->
	<div id="loadmore" class="fs06 fc06" style="display:none;"><img src="/images/front_img/loading.gif"></div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/system/adlist.js"></script>