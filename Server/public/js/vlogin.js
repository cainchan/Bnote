var vm = new Vue({
	el:"#web",
	data:{
		email:'',
		password:'',
	},
	filters:{

	},
	mounted:function(){
		this.$nextTick(function(){
			
		})
	},
	methods:{
		login:function(){
			var param = {'email':this.email,'password':this.password};
			var _this = this;
			axios.post('/api/v1/login',param).then(function (res) {
		    	console.log(res.data);
		    	if (res.data.code == 1){
		    		window.location.href = '/';
		    	}
			});
		}
	}
});