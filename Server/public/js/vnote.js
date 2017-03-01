var vm = new Vue({
	el:"#web",
	data:{
		username:"KayChen",
		notebooks:[],
		notes : [],
		latestnotes:[],
		note: {},
		notebook_name:"最近"
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
			if (this.latestnotes.length == 0){
				var _this = this;
				axios.get('/api/v1/note').then(function (res) {
			    	_this.notes = res.data;
			    	_this.latestnotes = res.data;
			    	_this.getNote(_this.notes[0]);
			    	_this.notebook_name = "最近";
				});
			}else{
				this.notes = this.latestnotes;
				this.getNote(this.notes[0]);
				this.notebook_name = "最近";
			}

		},
		getNotes:function(notebook){
			var _this = this;
			var needload = 0;

			_this.notebook_name = notebook.name;
			if (notebook.hasOwnProperty('notes') === false){
				console.log(notebook.notes);
				axios.get('/api/v1/note/notebook/'+notebook.id).then(function (res) {
			    	_this.notes = res.data;
			    	_this.$set(notebook,"notes",res.data);
				});
			}else{
				_this.notes = notebook.notes;
			}
			_this.note = _this.notes[0];

		},
		getNote:function(note){
			this.note = note;
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
	}
});