import Vue from 'vue'
import Router from 'vue-router'
import hello from '@/components/hello'
import login from '@/components/login'

Vue.use(Router)
const router = new Router({
	mode: 'history',
  	routes: [
    {
      path: '/',
      name: 'hello',
      component: hello
    },
    {
      path: '/login',
      name: 'login',
      component: login
    }
  ]
})
router.beforeEach((to, from, next) => {
	if (to.path != '/'){
		console.log('verify login');
	}
	if (to.path == '/'){
		console.log('login verify login');
		// next('/test')
	}
	next()
})
export default router
