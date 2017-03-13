<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index</title>
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.bootcss.com/highlight.js/9.9.0/styles/default.min.css">
<link rel="stylesheet" href="https://cdn.bootcss.com/jquery-contextmenu/2.4.3/jquery.contextMenu.min.css">
<link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
<div id="web" class="text-center">
	<p><h3>蜜蜂笔记</h3></p>
	<div class="login form-horizontal">
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-3 control-label">邮箱</label>
	    <div class="col-sm-9">
	      <input type="email" class="form-control" v-model="email" placeholder="邮箱">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputPassword3" class="col-sm-3 control-label">密码</label>
	    <div class="col-sm-9">
	      <input type="password" class="form-control" v-model="password" placeholder="密码">
	    </div>
	  </div>
	  <a type="button" class="btn btn-default" v-on:click="login()">登录</a>
	  <a type="button" href="/user/reg" class="btn btn-default">注册</a>
	</div>
</div>
<script src="https://cdn.bootcss.com/vue/2.1.10/vue.min.js"></script>
<script src="https://cdn.bootcss.com/axios/0.15.3/axios.js"></script>
<script src="/public/js/vlogin.js"></script>
</body>
</html>