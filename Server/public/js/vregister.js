var vm = new Vue({
	el:"#web",
	data:{
		email:'',
		password:'',
		password2:'',
	},
	filters:{

	},
	mounted:function(){
		this.$nextTick(function(){
			
		})
	},
	methods:{
		register:function(){
			var param = {'email':this.email,'password':this.password,'password2':this.password2};
			var _this = this;
			axios.post('/api/v1/reg',param).then(function (res) {
		    	console.log(res.data);
		    	if (res.data.code == 1){
		    		alert('注册成功,去登录');
		    		window.location.href = '/user/login';
		    	}else{
		    		alert('注册失败:'+res.data.msg);
		    	}
			});
		}
	}
});