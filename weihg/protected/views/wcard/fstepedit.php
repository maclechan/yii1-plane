
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/wcard/fstep.css">
	<div class="g-load"></div>
	<form action="/wcard/wcardsave" method="post" enctype="multipart/form-data">
	<div class="g-body">
		<div class="g-head">
			<p>
				<a href="" id="count" class="f-fl f-tac fs09"><span class="fc09">我的现金</span></a>
				<a href="" id="perlist" class="f-fl f-tac fs09"><span class="fc09">赴宴名单</span></a>
				<a href="<?php echo $this->createUrl('cardshow');?>" id="send" class="f-fl f-tac fs09"><span class="fc09">发送请帖</span></a>
			</p>
		</div>
		<!-- 选择模板 -->
		<div class="g-main">
			<div class="m-list">
				<div class="m-style">
					<ul class="stybox">
						<li>
							<a href=""><img src="/images/front_img/tran.jpg"></a>
							<p class="f-tac fs08 fc12"><span data-sty="1"></span>革命风</p>
						</li>		
					</ul>
					<!-- 存放风格模板 -->
					<input id="hidden_1" type="hidden" name="themeid" class="hide">
				</div>
				<div class="g-btn">
					<span id="cfm1" class="f-fl fs09 fc09 f-tac"></span>
				</div>
			</div>
		</div>
		<!-- 上传资料 -->
		<div class="g-upres hide">
			<p class="fs09 fc06">新郎：<input id="male_nm" class="f-tal fs09 fc10" type="text" name="male_nm"></p>
			<p class="fs09 fc06">新娘：<input id="fem_nm" class="f-tal fs09 fc10" type="text" name="fem_nm"></p>
			<p class="fs09 fc06">婚礼时间：<input id="wed_tm" class="f-tal fs09 fc10" type="text" name="wed_tm"></p>
			<p class="fs09 fc06">婚礼地址：<input id="wed_ad" class="f-tal fs09 fc10" type="text" name="wed_ad"></p>
			<p id="r-map" class="fs09 fc03 f-tac">在地图上标注</p>
			<!-- <div class="g-side bg06"></div> -->
			<p  class="bdno fs09 fc06">致宾客：<input id="to_per" class="f-tal fs07 fc10" type="text" name="to_per"></p>
			<div class="g-side bg06"></div>
			<p id="pay" class="bdno fs09 fc06"><span id="c_box" class="f-fl"></span><span class="f-fl">&nbsp允许接收微信红包</span><span class="f-fl fc10">(在我的礼金中查看)</span></p>
			<!-- 存放是否接受红包 -->
			<input id="hidden_2" type="hidden" name="cashpacket" class="hide">

			<div class="g-side bg06"></div>
			<div class="g-btn">
				<span id="cfm2" class="f-fl fs09 fc09 f-tac"></span>
			</div>
		</div>
		<!-- 上传照片 -->
		<div class="g-upimg hide">
			<div class="fix_bar"></div>
			<ul class="f-fl">
				<li class="f-fl">
					<span class="f-del fc01 fs07 f-tac"></span>
					<input type="file" accept="images/*" name="WeddingPhoto[p_path][]">
					<p class="f-tac check"><span class="f-fl"></span><span class="f-fl fs08 fc01">设为封面</span></p>
				</li>
			</ul>

			<!-- 存放封面图对应的index值 -->
			<input id="hidden_3" type="hidden" name="cover" class="hide">

			<div class="g-btn">
				<span id="cfm3" class="f-fl fs09 fc09 f-tac"></span>
			</div>
		</div>
		<!-- 歌曲选择 -->
		<div class="g-sltmsc hide">
			<div class="m-box">
				<div class="timebar bg09"><span id="timer" class="bg07"></span></div>
				<span class="playbtn pause"></span>
			</div>
			<div class="msc_box">
				<div id="msc_box1">
					<div class="msc_check hide"></div>
					<audio id="music1" src="../../music/1.mp3"></audio>
					<span class="m_src fc01 fs08 f-tac">匆匆那年</span>
				</div>
				<div id="msc_box2">
					<div class="msc_check hide"></div>
					<audio id="music2" src="../../music/2.mp3"></audio>
					<span class="m_src fc01 fs08 f-tac">给我一个理由忘记</span>
				</div>
				<div id="msc_box3">
					<div class="msc_check hide"></div>
					<audio id="music3" src="../../music/3.mp3"></audio>
					<span class="m_src fc01 fs08 f-tac">她说</span>
				</div>
				<div id="msc_box4">
					<div class="msc_check hide"></div>
					<audio id="music4" src="../../music/4.mp3"></audio>
					<span class="m_src fc01 fs08 f-tac">情人</span>
				</div>
				<div id="msc_box5">
					<div class="msc_check hide"></div>
					<audio id="music5" src="../../music/5.mp3"></audio>
					<span class="m_src fc01 fs08 f-tac">我们的明天</span>
				</div>
			</div>
			<input id="hidden_4" type="hidden" name="music" class="hide" />
			<!-- 存放歌曲索引号 -->
		</div>
		<div class="g-foot bg06">
			<p>
				<button id="slt_m" class="f-fl fc11 fs08 f-tac bg05 cur">选择模版</button>
				<button id="up_res" class="f-fl fc11 fs08 f-tac bg05">上传资料</button>
				<button id="up_img" class="f-fl fc11 fs08 f-tac bg05">上传照片</button>
				<button id="slt_msc" class="f-fl fc11 fs08 f-tac bg05">选择歌曲</button>
				<button type="submit" id="pre_view" class="f-fl fc11 fs08 f-tac bg05">保存预览</button>
			</p>
			<span id="shadow"></span>
		</div>
	</div>
	</form>
	<div class="g-warn hide">
		<div>
			<p id="w-info" class="fc01 fs09 f-tac"></p>
			<p id="w-close" class="fc01 fs09 f-tac">确定</p>
		</div>
	</div>


<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/lib/jquery-1.11.2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/wcard/fstep.js"></script>