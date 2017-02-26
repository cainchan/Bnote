var vm = new Vue({
	el:"#web",
	data:{
		username:"KayChen",
		notebooks:[],
		notes : [],
		latestnotes:[],
		note: {},
		noteContent :{}
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
			axios.get('/data/getnotebooks.json').then(function (res) {
				var ret = eval(res.data);
		    	_this.notebooks = ret.notebooks;
			});
		},
		loadLastNotes:function(){
			if (this.latestnotes.length == 0){
				var _this = this;
				axios.get('/data/getlastnotes.json').then(function (res) {
			    	var ret = eval(res.data);
			    	_this.notes = ret.notes;
			    	_this.latestnotes = ret.notes;
			    	_this.getNote(_this.notes[0]);
			    	console.log(_this.notes);
				});
			}else{
				this.notes = this.latestnotes;
				this.getNote(this.notes[0]);
			}			
		},
		getNotes:function(notebook){
			var _this = this;
			var needload = 1;
			_this.notebooks.forEach(function(value,index){
				if (value.id == notebook.id && value.length >= 1){
					_this.notes = value.notes;
					needload = 0;
				}
			});
			if (needload == 1){
				axios.get('/data/getnotes.json?id='+notebook.id).then(function (res) {
			    	var ret = eval(res.data);
			    	_this.notes = ret.notes;
			    	_this.notebooks.forEach(function(value,index){
			    		if (value.id == notebook.id){
			    			value.notes = ret.notes;
			    		}
			    	});
				});
			}
			_this.note = _this.notes[0];

		},
		getNote:function(note){
			var _this = this;
			console.log(note);
			var needload = 1;
			if (note.hasOwnProperty('content') == false){
				needload = 0;
			}
			if (needload == 1){
				axios.get('/data/getNote.json?id='+note.id).then(function (res) {
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
			}
		},
		changeNoteBook:function(notebook){
			this.getNotes(notebook);
		},
	}
});