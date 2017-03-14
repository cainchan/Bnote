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
<div class="container-fluid" id="web">
  <div class="row">
	<nav class="navbar navbar-inverse navbar-static-top">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">BNote 蜜蜂笔记</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      
	      <ul class="nav navbar-nav navbar-right">

	      	<div class="navbar-form navbar-left">
	      		<div class="form-group">
	      		  <button class="btn btn-default" v-on:click="addNotebook()">新建笔记本</button>
		          <button class="btn btn-default" v-on:click="addNote()">新建MarkDown笔记</button>
		        </div>
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		      </div>
	        <li><a href="#">关于</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{username}}<span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">个人中心</a></li>
	            <li><a href="#">设置</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a v-on:click="logout()">退出</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
  </div>
  <div class="row content">
    <div class="col-md-2 sidebar">
    	<ul class="nav nav-pills nav-stacked">
		  <li role="presentation" class="active"><a href="#">笔记本</a>
		    <div class="notebooks">
			<ul class="list-group">
			  <li class="list-group-item" v-on:click="loadLastNotes()">最近</li>
			  <li class="list-group-item" v-if="addNotebookFlag"><input type="text" v-on:change="addNotebook()" v-model="new_notebook"></li>
			  <li class="list-group-item" v-for="book in notebooks" v-on:mouseover="mouseoverSet(book)" v-on:mouseout="mouseoutSet()">
			    <span class="badge" v-show="book.hoverSetFlag">
			    	<a href="javascript:;" data-toggle="dropdown" aria-haspopup="true"><span class="glyphicon glyphicon-asterisk"></span></a>
			    	<ul class="dropdown-menu dropdown-menu-right">
			            <li><a v-on:click="renameNotebook(book)">重命名</a></li>
			            <!-- <li role="separator" class="divider"></li> -->
			            <li v-if="book.count==0"><a v-on:click="deleteNotebook(book)">删除</a></li>
			        </ul>
			    </span>
			    <span v-on:click="changeNotebook(book)">{{book.name}}</span>
			    
			  </li>
			</ul>
			</div>
		  </li>
		  <li role="presentation"><a href="#">标签</a>
		  	<div class="tabs">
			<ul class="list-group">
			  <li class="list-group-item">
			    <span class="badge">0</span>
			    待添加
			  </li>
			</ul>
			</div>

		  </li>
		  <li role="presentation"><a href="#">Messages</a></li>
		</ul>
    </div>
    <div class="col-md-2 note-list">
    <span class="glyphicon glyphicon-book notebook-name" aria-hidden="true">{{notebook.name}}</span>
    <ul class="list-unstyled">
	  	<li class="note" v-for="note in notebook.notes" v-on:click="getNote(note)">
	    <span class="note-tilte">{{note.title}}</span>
	    {{note.desc}}
	  	</li>

    </ul>
    </div>
    <div class="col-md-8 note-content">
	    <form class="form-horizontal">
		  <div class="form-group">
		    <div class="col-sm-12">
		      <input type="text" class="form-control" placeholder="无标题" v-model="note.title">
		    </div>
		    <hr>
		    <div class="col-sm-12">
		    <ul class="nav nav-tabs">
		      <li role="presentation" v-bind:class="{'active':viewFlag}" v-on:click="viewNote()"><a href="#view" data-toggle="tab">查看</a></li>
			  <li role="presentation" v-bind:class="{'active':editFlag}" v-on:click="editNote()"><a href="#edit" data-toggle="tab">编辑</a></li>
			  <li role="presentation"><a href="javascript:;" id="note-save" v-on:click="saveNote()">保存</a></li>
			  <span class="hidden note-save-successed">保存成功</span>
			  <span class="hidden note-save-failed">保存失败</span>
			</ul>
			</div>
			<div class="col-sm-12">
			<div class="tab-content">
				<div class="tab-pane" id="view" v-bind:class="{'active':viewFlag}" v-html="note.html">
				</div>
				<div class="tab-pane" id="edit" v-bind:class="{'active':editFlag}">
				      <textarea class="form-control" rows="20" v-model="note.text"></textarea>	
				</div>
			</div>
			</div>		    
		  </div>
		  </form>
    </div>
  </div>
</div>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-contextmenu/2.4.3/jquery.contextMenu.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-contextmenu/2.4.3/jquery.ui.position.min.js"></script>
<script src="https://cdn.bootcss.com/highlight.js/9.9.0/highlight.min.js"></script>
<script src="https://cdn.bootcss.com/marked/0.3.6/marked.min.js"></script>
<script src="https://cdn.bootcss.com/vue/2.1.10/vue.min.js"></script>
<script src="https://cdn.bootcss.com/axios/0.15.3/axios.js"></script>
<script src="/public/js/vnote.js"></script>
</body>
</html>
