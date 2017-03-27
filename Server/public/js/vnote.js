var vm = new Vue({
	el:"#web",
	data:{
		username:"",
		notebooks:[],
		notebook:{},
		latest:{'name':"最近"},
		note: {},
		viewFlag:true,
		editFlag:false,
		addNotebookFlag:false,
		new_notebook:"",
		notebookRMenu:false,
		saveSuccessed:false,
		saveFailed:false,
	},
	filters:{

	},
	mounted:function(){
		this.$nextTick(function(){
			this.veryfyLogin();
			this.loadNoteBooks();
			this.loadLastNotes();
		})
	},
	methods:{
		veryfyLogin:function(){
			var _this = this;			
			axios.get('/api/v1/verifyLogin').then(function (res) {
		    	if (res.data.code == 1){
		    		_this.username = res.data.email;	
		    	}else{
		    		window.location.href = '/user/login';
		    	}
			});
		},
		logout:function(){
			axios.get('/api/v1/logout').then(function (res) {
		    	if (res.data.code == 1){
		    		window.location.href = '/user/login';	
		    	}
			});
		},
		loadNoteBooks:function(){
			var _this = this;			
			axios.get('/api/v1/notebook').then(function (res) {
		    	_this.notebooks = res.data;
			});
		},
		loadLastNotes:function(){
			if (this.latest.hasOwnProperty('notes') === false){
				var _this = this;
				axios.get('/api/v1/note').then(function (res) {
					_this.$set(_this.latest,"notes",res.data);
			    	_this.notebook = _this.latest;
			    	_this.getNote(_this.notebook.notes[0]);
				});
			}else{
				this.notebook = this.latest;
				this.getNote(this.notebook.notes[0]);
			}

		},
		getNotes:function(notebook){
			this.notebook = notebook;
			if (notebook.hasOwnProperty('notes') === false){
				var _this = this;
				axios.get('/api/v1/note/notebook/'+notebook.id).then(function (res) {
			    	_this.$set(notebook,"notes",res.data);
			    	_this.note = _this.notebook.notes[0];
				});
			}else{
				this.note = this.notebook.notes[0];
			}
		},
		getNote:function(note){
			this.note = note;
			this.editFlag = false;
			this.viewFlag = true;
		},
		changeNotebook:function(notebook){
			this.getNotes(notebook);
		},
		clickNotebook:function(notebook){
			var event=window.event;
			//判断是左键还是右键
			if (event.button == "2"){
				/*var rMenu = document.getElementById("rmenu");
				rMenu.style.top = event.clientY + "px";
				rMenu.style.left = event.clientX + "px";
				this.notebookRMenu = true;
				document.oncontextmenu = function(event){
					event.preventDefault();
				}
				console.log("right");*/
			}else{
				this.getNotes(notebook);
				this.notebookRMenu = false;
			}
		},
		addNotebook:function(){
			this.addNotebookFlag = true;
			if (this.new_notebook != ""){
				var notebook = {"name":this.new_notebook}
				this.notebooks.unshift(notebook);
				// 调用新增笔记本接口
				var _this = this;
				axios.post('/api/v1/notebook',notebook).then(function (res) {
			    	console.log(res.data);
			    	_this.$set(_this.notebooks[0],"id",res.data.id);
			    	_this.addNotebookFlag = false;
			    	_this.new_notebook = "";
				});
			}
		},
		addNote:function(){
			var note = {"title":"无标题","text":"","html":""}
			if (this.note){
				note['notebook_id'] = this.note.notebook_id;
			}else{
				note['notebook_id'] = this.notebook.id;
			}
			this.note = note;
			this.notebook.notes.unshift(note);
			this.editFlag = true;
			this.viewFlag = false;
			// 调用新增笔记接口
			var _this = this;
			axios.post('/api/v1/note',note).then(function (res) {				
		    	_this.$set(_this.note,"id",res.data.id);
			});
		},
		saveNote:function(){
			this.note.html = marked(this.note.text);
			var _this = this;
			axios.put('/api/v1/note/id/'+this.note.id,this.note).then(function (res) {
				_this.saveSuccessed = true;
			});
		},
		clearSaveStatus:function(){
			this.saveSuccessed = false;
			this.saveFailed = false;
		},
		viewNote:function(){
			this.editFlag = false;
			this.viewFlag = true;
			this.note.html = marked(this.note.text);
			/*var _this = this;
			axios.post('/api/v1/markdown2html',this.note).then(function (res) {
		    	_this.note.html = res.data.html;
			});*/
		},
		editNote:function(){
			this.editFlag = true;
			this.viewFlag = false;
		},
		deleteNote:function(){
			var _this = this;
			axios.delete('/api/v1/note/id/'+_this.note.id).then(function (res) {
		    	console.log(res.data);
		    	_this.latest = {'name':'最近'}
		    	_this.loadNoteBooks();
		    	_this.loadLastNotes();
			});
		},
		mouseoverSet:function(notebook){
			this.mouseoutSet();
	    	this.$set(notebook,"hoverSetFlag",true);
		},
		mouseoutSet:function(){
			var _this = this;
			_this.notebooks.forEach(function(book,index){
				_this.$set(book,"hoverSetFlag",false);
	    	});
		},
		showRenameNotebook:function(notebook){
			notebook.rename = true;
			console.log(notebook.name);
		},
		saveNotebookName:function(notebook){
			notebook.rename = false;
			var param = {'name':notebook.name}
			var _this = this;
			axios.put('/api/v1/notebook/id/'+notebook.id,param).then(function(res){
				_this.loadNoteBooks();
			});
		},
		deleteNotebook:function(notebook){
			var _this = this;
			// 服务端删除
			axios.delete('/api/v1/notebook/id/'+notebook.id).then(function (res) {
		    	_this.loadNoteBooks();
			});
		},
	}
});