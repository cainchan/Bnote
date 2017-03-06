var vm = new Vue({
	el:"#web",
	data:{
		username:"KayChen",
		notebooks:[],
		notebook:{},
		latest:{'name':"最近"},
		note: {},
		viewFlag:true,
		editFlag:false

	},
	filters:{

	},
	mounted:function(){
		this.$nextTick(function(){
			this.loadNoteBooks()
			this.loadLastNotes()
		})
	},
	methods:{
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
			/*

			var needload = 1;
			if (note.hasOwnProperty('text') == false){
				needload = 0;
			}
			if (needload == 1){
				axios.get('/public/data/getNote.json?id='+note.id).then(function (res) {
			    	var ret = eval(res.data);
			    	_this.note = ret;
			    	console.log(ret)
			    	_this.notebooks.forEach(function(book,index){
			    		if (book.id == ret.notebook_id){
			    			book.notes.forEach(function(value,index2){
			    				if (value.id == ret.id){
			    					value = ret;
			    				}
			    			});
			    		}
			    	});
				});
			}*/
		},
		changeNoteBook:function(notebook){
			this.getNotes(notebook);
		},
		addNote:function(){
			var note = {"title":"无标题","text":"","html":""}
			this.note = note;
			this.notebook.notes.unshift(note);
			this.editFlag = true;
			this.viewFlag = false;
			// 调用新增笔记接口
			var _this = this;
			axios.post('/api/v1/note',note).then(function (res) {
		    	console.log(res.data);
			});
		},
		saveNote:function(){
			axios.put('/api/v1/note/id/'+this.note.id,this.note).then(function (res) {
		    	console.log(res.data);
			});
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
		}

	}
});
hljs.initHighlightingOnLoad();