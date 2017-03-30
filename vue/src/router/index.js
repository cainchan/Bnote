import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import Hello2 from '@/components/Hello2'

Vue.use(Router)
const router = new Router({
	mode: 'history',
  	routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello
    },
    {
      path: '/test',
      name: 'Hello2',
      component: Hello2
    }
  ]
})
router.beforeEach((to, from, next) => {
	if (to.path != '/'){
		console.log('verify login');
	}
	if (to.path == '/'){
		console.log('login verify login');
		next('/test')
	}
	next()
})
export default router
