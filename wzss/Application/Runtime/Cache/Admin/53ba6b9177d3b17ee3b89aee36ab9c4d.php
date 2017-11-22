<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>后台管理</title>
	<link rel="stylesheet" href="/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="/css/font_eolqem241z66flxr.css" media="all" />
	<link rel="stylesheet" href="/css/main.css" media="all" />
</head>
<body class="main_body">
	<div class="layui-layout layui-layout-admin">
		<!-- 顶部 -->
		<div class="layui-header header">
			<div class="layui-main">
				<a href="#" class="logo">WZSS后台管理</a>
				<!-- 搜索 -->
				<div class="layui-form component" style="width: 220px;margin-top:20px;">
					<span id="now_time" style="color: white">正在加载</span>
			    </div>
				<script>
                    var ns4up1 = (document.layers) ? 1 : 0;  // browser sniffer

                    var ie4up1 = (document.all&&(navigator.appVersion.indexOf("MSIE 4") == -1)) ? 1 : 0;

                    var ns6up1 = (document.getElementById&&!document.all) ? 1 : 0;

                    function nowclock() {
                        if (!ns4up1 && !ie4up1 && !ns6up1) return false;
                        var digital = new Date();
                        var hours = digital.getHours();
                        var minutes = digital.getMinutes();
                        var seconds = digital.getSeconds();
                        var day = digital.getDate();
                        var month = digital.getMonth() + 1;
                        var year = digital.getFullYear();
						/* if (hours > 11) amOrPm = "PM";
						 if (hours > 12) hours = hours - 12;*/
                        var xingqi = '日一二三四五六'.charAt(new Date().getDay());
                        if (hours == 0) hours = 12;
                        if (minutes < 10) minutes = "0" + minutes;
                        if (seconds < 10) seconds = "0" + seconds;
                        if (day < 10) day = "0" + day;
                        if (month < 10) month = "0" + month;
                        dispTime = hours + ":" + minutes + ":" + seconds + " 星期"+xingqi;
                        dispDate = year + "年" + month + "月" + day+ "日  " ;
                        if (ns4up1) {
                            document.layers.nowTime.document.write(dispDate+dispTime);
                            document.layers.nowTime.document.close();
                        } else if (ns6up1){
                            document.getElementById("now_time").innerHTML = dispDate+dispTime;
                        } else if (ie4up1){
                            nowTime.innerHTML = dispDate+dispTime;
                        } setTimeout("nowclock()", 1000);
                    } nowclock();
                    //-->
				</script>
			    <!-- 天气信息 -->
			    <div class="weather" pc>
			    	<div id="tp-weather-widget"></div>
					<script>(function(T,h,i,n,k,P,a,g,e){g=function(){P=h.createElement(i);a=h.getElementsByTagName(i)[0];P.src=k;P.charset="utf-8";P.async=1;a.parentNode.insertBefore(P,a)};T["ThinkPageWeatherWidgetObject"]=n;T[n]||(T[n]=function(){(T[n].q=T[n].q||[]).push(arguments)});T[n].l=+new Date();if(T.attachEvent){T.attachEvent("onload",g)}else{T.addEventListener("load",g,false)}}(window,document,"script","tpwidget","//widget.seniverse.com/widget/chameleon.js"))</script>
					<script>tpwidget("init", {
					    "flavor": "slim",
					    "location": "WX4FBXXFKE4F",
					    "geolocation": "disabled",
					    "language": "zh-chs",
					    "unit": "c",
					    "theme": "chameleon",
					    "container": "tp-weather-widget",
					    "bubble": "disabled",
					    "alarmType": "badge",
					    "color": "#FFFFFF",
					    "uid": "U9EC08A15F",
					    "hash": "14dff75e7253d3a8b9727522759f3455"
					});
					tpwidget("show");</script>
			    </div>
			    <!-- 顶部右侧菜单 -->
			    <ul class="layui-nav top_menu">
			    	<li class="layui-nav-item showNotice" id="showNotice" pc>
						<a href="javascript:;"><i class="iconfont icon-gonggao"></i><cite>系统公告</cite></a>
					</li>
			    	<li class="layui-nav-item" mobile>
			    		<a href="javascript:;" data-url="page/user/changePwd.html"><i class="iconfont icon-shezhi1" data-icon="icon-shezhi1"></i><cite>设置</cite></a>
			    	</li>
			    	<li class="layui-nav-item" mobile>
			    		<a href="javascript:;"><i class="iconfont icon-loginout"></i> 退出</a>
			    	</li>
					<li class="layui-nav-item lockcms" pc>
						<a href="javascript:;"><i class="iconfont icon-lock1"></i><cite>锁屏</cite></a>
					</li>
					<li class="layui-nav-item" pc>
						<a href="javascript:void(0);">
							<img src="/images/face.jpg" class="layui-circle" width="35" height="35">
							<cite>请叫我马哥</cite>
							<span class="layui-nav-more"></span>
						</a>
						<dl class="layui-nav-child">
							<dd><a href="javascript:;" data-url="page/user/userInfo.html"><i class="iconfont icon-zhanghu" data-icon="icon-zhanghu"></i><cite>个人资料</cite></a></dd>
							<dd><a href="javascript:;" data-url="page/user/changePwd.html"><i class="iconfont icon-shezhi1" data-icon="icon-shezhi1"></i><cite>修改密码</cite></a></dd>
							<dd><a href="javascript:;"><i class="iconfont icon-loginout"></i><cite>退出</cite></a></dd>
						</dl>
					</li>
				</ul>
			</div>
		</div>
		<!-- 左侧导航 -->
		<div class="layui-side layui-bg-black">
			<div class="user-photo">
				<a class="img" title="我的头像" ><img src="/images/face.jpg"></a>
				<p>你好！<span class="userName">请叫我马哥</span>, 欢迎登录</p>
			</div>
			<div class="navBar layui-side-scroll">

			</div>
		</div>
		<!-- 右侧内容 -->
		<div class="layui-body layui-form">
			<div class="layui-tab marg0" lay-filter="bodyTab">
				<ul class="layui-tab-title top_tab">
					<li class="layui-this" lay-id=""><i class="iconfont icon-computer"></i> <cite>后台首页</cite></li>
				</ul>
				<div class="layui-tab-content clildFrame">
					<div class="layui-tab-item layui-show">
						<iframe src="/Admin/Index/main"></iframe>
					</div>
				</div>
			</div>
		</div>
		<!-- 底部 -->
		<div class="layui-footer footer">
			<p>copyright @2017 请叫我马哥 更多模板：<a href="http://www.mycodes.net/" target="_blank">源码之家</a>　　<a onclick="donation()" class="layui-btn layui-btn-danger l·ayui-btn-small">捐赠作者</a></p>
		</div>
	</div>

	<!-- 锁屏 -->
	<div class="admin-header-lock" id="lock-box" style="display: none;">
		<div class="admin-header-lock-img"><img src="/images/face.jpg"/></div>
		<div class="admin-header-lock-name" id="lockUserName">请叫我马哥</div>
		<div class="input_btn">
			<input type="password" class="admin-header-lock-input layui-input" placeholder="请输入密码解锁.." name="lockPwd" id="lockPwd" />
			<button class="layui-btn" id="unlock">解锁</button>
		</div>
		<p>请输入“123456”，否则不会解锁成功哦！！！</p>
	</div>
	<!-- 移动导航 -->
	<div class="site-tree-mobile layui-hide"><i class="layui-icon">&#xe602;</i></div>
	<div class="site-mobile-shade">
	</div>

	<script type="text/javascript" src="/layui/layui.js"></script>
	<script type="text/javascript" src="/js/nav.js"></script>
	<script type="text/javascript" src="/js/leftNav.js"></script>
	<script type="text/javascript" src="/js/index.js"></script>
	<script type="text/javascript" src="/js/bodyTab.js"></script>
</body>
</html>