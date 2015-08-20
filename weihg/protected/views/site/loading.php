<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/system/index.css">
	<style type="text/css">
		#sec0{
			background: url(/images/front_img/sec0bg.jpg) no-repeat;
			background-size: 100% 100%;
		}
		#sec0 #img1-1{
			z-index: 2;
			position: absolute;
			top: 0;
			left: 0;
		}
		#sec0 #img1-2{
			z-index: 2;
			position: absolute;
			top: 0;
			right: 0;
			-webkit-transform:rotateY(180deg);
			transform:rotateY(180deg);
		}
		#sec0 #m1-border{
			position: absolute;
			left: 40px;
			width: 560px;
			height: 715px;
			top:66px; 
			background-color: #000;
			background-image:url(/images/front_img/sec0border.jpg);
			background-size: 100% 100%;
			overflow: hidden;
		}
		#sec0 #img1-3{
			z-index: 1;
			position: absolute;
			opacity: 0.2;
			top: -60px;
			left: -40px;
			-webkit-animation:fadein 0.4s 3s 1 both;
			-moz-animation:fadein 0.4s 3s 1 both;
			animation:fadein 0.4s 3s 1 both;
		}
		#sec0 #img1-4{
			z-index: 1;
			position: absolute;
			opacity: 0.2;
			top: -60px;
			right: -40px;
			-webkit-transform:rotateY(180deg);
			transform:rotateY(180deg);
			-webkit-animation:fadein 0.4s 3s 1 both;
			-moz-animation:fadein 0.4s 3s 1 both;
			animation:fadein 0.4s 3s 1 both;
		}
		#sec0 #img1-5{
			z-index: 1;
			position: absolute;
			left: 126px;
			top: 340px;
			-webkit-animation:fadein 0.4s 3.6s 1 both;
			-moz-animation:fadein 0.4s 3.6s 1 both;
			animation:fadein 0.4s 3.6s 1 both;
		}
		#sec0 #img1-6{
			position: absolute;
			z-index: 2;
			left: 188px;
			top:262px ;
			-webkit-animation:fadein 0.4s 6s 1 both;
			-moz-animation:fadein 0.4s 6s 1 both;
			animation:fadein 0.4s 6s 1 both;
		}
		#sec0 #img1-7{
			position: absolute;
			z-index: 2;
			left:254px ;
			top: 154px;
			-webkit-animation:fadein 0.4s 6.6s 1 both;
			-moz-animation:fadein 0.4s 6.6s 1 both;
			animation:fadein 0.4s 6.6s 1 both;
		}
		#sec0 #img1-8{
			position: absolute;
			z-index: 2;
			left:168px ;
			top:20px ;
			-webkit-animation:fadein 0.4s 7.2s 1 both;
			-moz-animation:fadein 0.4s 7.2s 1 both;
			animation:fadein 0.4s 7.2s 1 both;
		}
		#sec0 #img1-9{
			position: absolute;
			z-index: 2;
			left:344px;
			top: 5px;
			-webkit-animation:fadein 0.4s 7.8s 1 both;
			-moz-animation:fadein 0.4s 7.8s 1 both;
			animation:fadein 0.4s 7.8s 1 both;
		}
		#sec0 #img1-10{
			position: absolute;
			z-index: 2;
			left:260px;
			top: 220px;
			-webkit-animation:fadein 0.4s 9s 1 both;
			-moz-animation:fadein 0.4s 9s 1 both;
			animation:fadein 0.4s 9s 1 both;
		}
		#sec0 #img1-11{
			position: absolute;
			z-index: 2;
			left:200px;
			top: 120px;
			-webkit-animation:fadein 0.4s 9.6s 1 both;
			-moz-animation:fadein 0.4s 9.6s 1 both;
			animation:fadein 0.4s 9.6s 1 both;
		}
		#sec0 .m-bubble{
			z-index: 3;
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			overflow: hidden;
		}
		#sec0 .m-bubble img{
			position: absolute;
		}
		.m-bubble #b-1{
			top:21%;
			left:26.3%; 
			-webkit-animation:fadeout 5s 11.6s 1 both;
			-moz-animation:fadeout 5s 11.6s 1 both;
			animation:fadeout 5s 11.6s 1 both;
		}
		.m-bubble #b-2{
			top:5%;
			left:31%; 
			-webkit-animation:fadeout 5s 12.1s 1 both;
			-moz-animation:fadeout 5s 12.1s 1 both;
			animation:fadeout 5s 12.1s 1 both;
		}
		.m-bubble #b-3{
			top:56%;
			left:8.5%; 
			-webkit-animation:fadeout 5s 12.6s 1 both;
			-moz-animation:fadeout 5s 12.6s 1 both;
			animation:fadeout 5s 12.6s 1 both;
		}
		.m-bubble #b-4{
			top:0.1%;
			right:0.3%; 
			-webkit-animation:fadeout 5s 13.1s 1 both;
			-moz-animation:fadeout 5s 13.1s 1 both;
			animation:fadeout 5s 13.1s 1 both;
		}
		.m-bubble #b-5{
			top:14%;
			left:0.3%; 
			-webkit-animation:fadeout 5s 13.6s 1 both;
			-moz-animation:fadeout 5s 13.6s 1 both;
			animation:fadeout 5s 13.6s 1 both;
		}
		.m-bubble #b-6{
			top:0.1%;
			left:8%; 
			-webkit-animation:fadeout 5s 14.1s 1 both;
			-moz-animation:fadeout 5s 14.1s 1 both;
			animation:fadeout 5s 14.1s 1 both;
		}
		.m-bubble #b-7{
			top:37.5%;
			left:0.3%; 
			-webkit-animation:fadeout 5s 14.6s 1 both;
			-moz-animation:fadeout 5s 14.6s 1 both;
			animation:fadeout 5s 14.6s 1 both;
		}
		.m-bubble #b-8{
			top:49.4%;
			right:8%; 
			-webkit-animation:fadeout 5s 15.1s 1 both;
			-moz-animation:fadeout 5s 15.1s 1 both;
			animation:fadeout 5s 15.1s 1 both;
		}
		.m-bubble #b-9{
			top:21.7%;
			right:3%; 
			-webkit-animation:fadeout 5s 15.6s 1 both;
			-moz-animation:fadeout 5s 15.6s 1 both;
			animation:fadeout 5s 15.6s 1 both;
		}
		.m-bubble #b-10{
			top:5%;
			left:18%; 
			-webkit-animation:fadein .6s 20s 1 both;
			-moz-animation:fadein .6s 20s 1 both;
			animation:fadein .6s 20s 1 both;
		}
@-webkit-keyframes fadein{
    0%{opacity:0;}
    100%{opacity:1;}
}
@-moz-keyframes fadein{
    0%{opacity:0;}
    100%{opacity:1;}
}
@keyframes fadein{
    0%{opacity:0;}
    100%{opacity:1;}
}
@-webkit-keyframes fadeout{
    0%{opacity:0;-webkit-transform:scale(0.5);}
    10%{opacity: 0.5;-webkit-transform:scale(0.5);}
    20%{opacity: 1;-webkit-transform:scale(0.6);}
    30%{opacity: 1;-webkit-transform:scale(0.7);}
    50%{opacity: 1;-webkit-transform:scale(0.8);}
    60%{opacity: 1;-webkit-transform:scale(0.9);}
    80%{opacity: 1;-webkit-transform:scale(1);}
    90%{opacity: 0.5;}
    100%{opacity:0;}
}
@-moz-keyframes fadeout{
    0%{opacity:0;}
    10%{opacity: 0.5;}
    20%{opacity: 1;}
    90%{opacity: 0.5;}
    100%{opacity:0;}
}
@-ms-keyframes fadeout{
    0%{opacity:0;}
    10%{opacity: 0.5;}
    20%{opacity: 1;}
    90%{opacity: 0.5;}
    100%{opacity:0;}
}
@keyframes fadeout{
    0%{opacity:0;}
    10%{opacity: 0.5;}
    20%{opacity: 1;}
    90%{opacity: 0.5;}
    100%{opacity:0;}
}
	</style>
	<div class="g-load"></div>
	<div class="g-body">
		<div class="m-sec">
			<section id="sec0" class="sec show">
				<img id="img1-1" src="/images/front_img/curtain.png">
				<img id="img1-2" src="/images/front_img/curtain.png">
				<div id="m1-border">
					<img id="img1-5" src="/images/front_img/status1.png">
					<img id="img1-6" src="/images/front_img/will.png">
					<img id="img1-7" src="/images/front_img/you.png">
					<img id="img1-8" src="/images/front_img/marry.png">
					<img id="img1-9" src="/images/front_img/me.png">
					<img id="img1-10" src="/images/front_img/yes.png">
					<img id="img1-11" src="/images/front_img/ido.png">
					<div class="m-bubble">
						<img id="b-1" src="/images/front_img/letterpng/siyi.png">
						<img id="b-2" src="/images/front_img/letterpng/cehua.png">
						<img id="b-3" src="/images/front_img/letterpng/miyue.png">
						<img id="b-4" src="/images/front_img/letterpng/sheying.png">
						<img id="b-5" src="/images/front_img/letterpng/hungo.png">
						<img id="b-6" src="/images/front_img/letterpng/luxian.png">
						<img id="b-7" src="/images/front_img/letterpng/haiwai.png">
						<img id="b-8" src="/images/front_img/letterpng/changdi.png">
						<img id="b-9" src="/images/front_img/letterpng/xinniang.png">
						<img id="b-10" src="/images/front_img/letterpng/weihungo.png">
					</div>
				</div>
				
				<div class="arrow"></div>
			</section>		
			<section id="sec1" class="sec">
				<div class="m-con">
					<p id="m-txt1" class="fs15 fc02 fw01 f-tac">寻找</p>
					<p id="m-txt2" class="fs16 fw01 fc03 f-tac">专属</p>
					<p id="m-txt3" class="fs15 fc02 fw01 f-tac">婚礼顾问</p>
					<div id="bird1"></div>
				</div>
				<div id="diomd1" class="m-diomd"></div>
				<div id="diomd2" class="m-diomd"></div>
				<div class="arrow"></div>
			</section>
			<section id="sec2" class="sec">
				<p class="m-ttl f-tac"><span class=" fs12 fc02 bd02 br01">我的所属年代</span></p>
				<div id="diomd3" class="m-diomd"></div>
				<div id="diomd4" class="m-diomd"></div>
				<div class="m-age">
					<p class="m-cirimg" id="fm90" emsg="90"><img src="/images/front_img/fm90.jpg" /></p>
					<p class="m-cirimg" id="fm85" emsg="85"><img src="/images/front_img/fm85.jpg" /></p>
					<p class="m-cirimg" id="fm80" emsg="80"><img src="/images/front_img/fm80.jpg" /></p>
					<p class="m-cirimg" id="fm70" emsg="70"><img src="/images/front_img/fm70.jpg" /></p>
					<p class="m-cirimg" id="f90" emsg="90"><img src="/images/front_img/m70.jpg" /></p>
					<p class="m-cirimg" id="f85" emsg="85"><img src="/images/front_img/m80.jpg" /></p>
					<p class="m-cirimg" id="f80" emsg="80"><img src="/images/front_img/m85.jpg" /></p>
					<p class="m-cirimg" id="f70" emsg="70"><img src="/images/front_img/m90.jpg" /></p>
				</div>
				<div class="m-bird" id="bird2"></div>
				<div class="arrow"></div>
			</section>
			<section id="sec3" class="sec">
				<p class="m-ttl f-tac"><span class="fs12 fc02 bd02 br01">我的星座</span></p>
				<div class="m-cnst">
					<p class="m-cirimg" id="cnst1" emsg="shuiping"><img src="/images/front_img/cnst1.jpg" /></p>
					<p class="m-cirimg" id="cnst2" emsg="mojie"><img src="/images/front_img/cnst2.jpg" /></p>
					<p class="m-cirimg" id="cnst3" emsg="sheshou"><img src="/images/front_img/cnst3.jpg" /></p>
					<p class="m-cirimg" id="cnst4" emsg="tianxie"><img src="/images/front_img/cnst4.jpg" /></p>
					<p class="m-cirimg" id="cnst5" emsg="tianping"><img src="/images/front_img/cnst5.jpg" /></p>
					<p class="m-cirimg" id="cnst6" emsg="chunv"><img src="/images/front_img/cnst6.jpg" /></p>
					<p class="m-cirimg" id="cnst7" emsg="shizi"><img src="/images/front_img/cnst7.jpg" /></p>
					<p class="m-cirimg" id="cnst8" emsg="juxie"><img src="/images/front_img/cnst8.jpg" /></p>
					<p class="m-cirimg" id="cnst9" emsg="shuangzi"><img src="/images/front_img/cnst9.jpg" /></p>
					<p class="m-cirimg" id="cnst10" emsg="jinniu"><img src="/images/front_img/cnst10.jpg" /></p>
					<p class="m-cirimg" id="cnst11" emsg="baiyang"><img src="/images/front_img/cnst11.jpg" /></p>
					<p class="m-cirimg" id="cnst12" emsg="shuangyu"><img src="/images/front_img/cnst12.jpg" /></p>
				</div>
				<div class="m-bird" id="bird3"></div>
				<div class="arrow"></div>
			</section>
			<section id="sec4" class="sec">
				<p class="m-ttl f-tac"><span class="fs12 fc02 bd02 br01">我的爱好</span></p>
				<div class="m-fav">
					<p class="m-cirimg" id="fav1" emsg="gaoerf"><img src="/images/front_img/fav1.jpg" /></p>
					<p class="m-cirimg" id="fav2" emsg="jianshen"><img src="/images/front_img/fav2.jpg" /></p>
					<p class="m-cirimg" id="fav3" emsg="lvyou"><img src="/images/front_img/fav3.jpg" /></p>
					<p class="m-cirimg" id="fav4" emsg="chihuo"><img src="/images/front_img/fav4.jpg" /></p>
					<p class="m-cirimg" id="fav5" emsg="tiaowu"><img src="/images/front_img/fav5.jpg" /></p>
					<p class="m-cirimg" id="fav6" emsg="yuedu"><img src="/images/front_img/fav6.jpg" /></p>
					<p class="m-cirimg" id="fav7" emsg="sheying"><img src="/images/front_img/fav7.jpg" /></p>
					<p class="m-cirimg" id="fav8" emsg="shechipin"><img src="/images/front_img/fav8.jpg" /></p>
					<p class="m-cirimg" id="fav9" emsg="maiba"><img src="/images/front_img/fav9.jpg" /></p>
				</div>
				<div class="m-bird" id="bird4"></div>
				<div class="arrow"></div>
			</section>
			<section id="sec5" class="sec">
				<p class="m-ttl f-tac"><span class="fs12 fc02 bd02 br01">我要的婚礼风格</span></p>
				<div class="m-style">
					<p class="m-cirimg" id="style1" emsg="4"><img src="/images/front_img/style1.jpg" /></p>
					<p class="m-cirimg" id="style2" emsg="9"><img src="/images/front_img/style2.jpg" /></p>
					<p class="m-cirimg" id="style3" emsg="10"><img src="/images/front_img/style3.jpg" /></p>
					<p class="m-cirimg" id="style4" emsg="1"><img src="/images/front_img/style4.jpg" /></p>
					<p class="m-cirimg" id="style5" emsg="2"><img src="/images/front_img/style5.jpg" /></p>
					<p class="m-cirimg" id="style6" emsg="3"><img src="/images/front_img/style6.jpg" /></p>
					<p class="m-cirimg" id="style7" emsg="5"><img src="/images/front_img/style7.jpg" /></p>
					<p class="m-cirimg" id="style8" emsg="12"><img src="/images/front_img/style8.jpg" /></p>
					<p class="m-cirimg" id="style9" emsg="7"><img src="/images/front_img/style9.jpg" /></p>
				</div>
			</section>
				<form action="<?php echo $this->createUrl('indexfm');?>" method="post">
						<!-- 年代存值 -->
						<input id="Ages" type="hidden" name="age" class="hide" />
						<!-- 星座存值 -->
						<input id="Const" type="hidden" name="const" class="hide" />
						<!-- 爱好存值 -->
						<input id="Fav" type="hidden" name="fav" class="hide" />
						<!-- 婚礼风格存值 -->
						<input id="Hlsty" type="hidden" name="hlsty" class="hide" />

						<!-- 提交按钮 -->
						<p class="m-done f-tac">
							<input type="submit" class="m-btn fs12 fc01 bd02 br01 bg05" value="完成" />
						</p>
				</form>			
		</div>
	</div>
<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/system/index.js"></script>
<script type="text/javascript">
	$(function(){
		$("#img1-1").delay(400).animate({left:"-280px"},2000);
		$("#img1-2").delay(400).animate({right:"-280px"},2000);
		setTimeout(function(){
			$("#m1-border").css("background-image","url(/images/front_img/sec0border1.jpg)");
		},3000);
		setTimeout(function(){
			$("#img1-5").attr("src","/images/front_img/status2.png");
		},5500);
		setTimeout(function(){
			$("#img1-6").css("display","none");
			$("#img1-7").css("display","none");
			$("#img1-8").css("display","none");
			$("#img1-9").css("display","none");
		},8800);
		setTimeout(function(){
			$("#img1-5").attr("src","/images/front_img/status3.png");
		},11000);
		setTimeout(function(){
			$("#img1-10").css("display","none");
			$("#img1-11").css("display","none");
		},11000);
	});
</script>