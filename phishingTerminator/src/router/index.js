import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/index',
      name: 'index',
      component: () => import('../views/IndexView.vue')
    },
    {
      path: '/p01',
      name: 'p01',
      component: () => import('../views/p01_news.vue')
    },
    {
      path: '/p02',
      name: 'p02',
      component: () => import('../views/p02_teach.vue')
    },
    {
      path: '/reportUrl',
      name: 'reportUrl',
      component: () => import('../views/p03_reportURL.vue')
    },
    {
      path: '/p04',
      name: 'p04',
      component: () => import('../views/p04_gov.vue')
    },
    {
      path: '/p05',
      name: 'p05',
      component: () => import('../views/p05_faq.vue')
    },
    {
      path: '/p06',
      name: 'p06',
      component: () => import('../views/p06_discuss.vue')
    },
    {
      path: '/p07demoShopping',
      name: 'p07demoShopping',
      component: () => import('../views/p07_demoShopping.vue')
    },
    {
      path: '/p07demoGame',
      name: 'p07demoGame',
      component: () => import('../views/p07_demoGame.vue')
    },
    {
      path: '/p07demoGamep01',
      name: 'p07demoGamep01',
      component: () => import('../views/p07_demoGame_p01.vue')
    },
    {
      path: '/p07demoPhone',
      name: 'p07demoPhone',
      component: () => import('../views/p07_demoPhone.vue')
    },
    {
      path: '/p07demoLine',
      name: 'p07demoLine',
      component: () => import('../views/p07_demoLine.vue')
    },
    {
      path: '/p08_user',
      name: 'p08_user',
      component: () => import('../views/p08_user.vue')
    },
    {
      path: '/p08_userLogin',
      name: 'p08_userLogin',
      component: () => import('../views/p08_userLogin.vue')
    },
    {
      path: '/p09_team',
      name: 'p09_team',
      component: () => import('../views/p09_team.vue')
    },
    {
      path: '/b_user',
      name: 'b_user',
      component: () => import('../views/b_user.vue')
    },
  ]
})

export default router