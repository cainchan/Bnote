import Vue from 'vue'
import Router from 'vue-router'
import bnote from '@/components/bnote'
import login from '@/components/login'

Vue.use(Router)
const router = new Router({
	mode: 'history',
  	routes: [
    {
      path: '/',
      name: 'bnote',
      component: bnote
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
