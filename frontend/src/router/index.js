import { createRouter, createWebHistory } from 'vue-router'
// import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/index',
    name: 'index',
    component: () => import(/* webpackChunkName: "about" */ '../views/IndexView.vue')
  },
  {
    path: '/p01',
    name: 'p01',
    component: () => import(/* webpackChunkName: "about" */ '../views/p01_news.vue')
  },
  {
    path: '/p01/p01_newsArticle/:id',
    name: 'newsArticle',
    component: () => import(/* webpackChunkName: "about" */ '../views/p01_newsArticle.vue')
  },
  {
    path: '/p02',
    name: 'p02',
    component: () => import(/* webpackChunkName: "about" */ '../views/p02_teach.vue')
  },
  {
    path: '/reportUrl',
    name: 'reportUrl',
    component: () => import(/* webpackChunkName: "about" */ '../views/p03_reportURL.vue')
  },
  {
    path: '/p04',
    name: 'p04',
    component: () => import(/* webpackChunkName: "about" */ '../views/p04_gov.vue')
  },
  {
    path: '/p05',
    name: 'p05',
    component: () => import(/* webpackChunkName: "about" */ '../views/p05_faq.vue')
  },
  {
    path: '/discuss',
    name: 'discuss',
    component: () => import(/* webpackChunkName: "about" */ '../views/p06_discuss.vue'),
  },
  {
    path: '/discuss_new_content',
    name: 'discuss_new_content',
    component: () => import(/* webpackChunkName: "about" */ '../views/p06_discuss_new_content.vue'),
  },
  {
    path: '/discuss/discuss_content/:article?',
    name: 'discuss_content',
    component: () => import(/* webpackChunkName: "about" */ '../views/p06_discuss_content.vue')
  },
  {
    path: '/p07demoShopping',
    name: 'p07demoShopping',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoShopping.vue')
  },
  {
    path: '/p07demoGame',
    name: 'p07demoGame',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoGame.vue')
  },
  {
    path: '/p07demoGamep01',
    name: 'p07demoGamep01',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoGame_p01.vue')
  },
  {
    path: '/p07demoGameresult',
    name: 'p07demoGameresult',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoGame_result.vue'),
    // props: (route) => ({ score: route.params.score })
    
  },
  {
    path: '/p07demoPhone',
    name: 'p07demoPhone',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoPhone.vue')
  },
  {
    path: '/p07demoLine',
    name: 'p07demoLine',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoLine.vue')
  },
  {
    path: '/p08_user',
    name: 'p08_user',
    component: () => import(/* webpackChunkName: "about" */ '../views/p08_user.vue')
  },
  {
    path: '/p08_userNotify',
    name: 'p08_userNotify',
    component: () => import(/* webpackChunkName: "about" */ '../views/p08_userNotify.vue')
  },
  {
    path: '/p08_userEditPwd',
    name: 'p08_userEditPwd',
    component: () => import(/* webpackChunkName: "about" */ '../views/p08_userEditPwd.vue')
  },
  {
    path: '/p08_userEdit',
    name: 'p08_userEdit',
    component: () => import(/* webpackChunkName: "about" */ '../views/p08_userEdit.vue')
  },
  {
    path: '/p08_userLogin',
    name: 'p08_userLogin',
    component: () => import(/* webpackChunkName: "about" */ '../views/p08_userLogin.vue')
  },
  {
    path: '/p09_team',
    name: 'p09_team',
    component: () => import(/* webpackChunkName: "about" */ '../views/p09_team.vue')
  },
  {
    path: '/b_index',
    name: 'b_index',
    component: () => import(/* webpackChunkName: "about" */ '../views/b_index.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
