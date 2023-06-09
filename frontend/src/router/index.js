import { createRouter, createWebHistory } from 'vue-router'
import Home from '../App.vue'
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/index',
    name: 'index',
    component: () => import(/* webpackChunkName: "about" */ '../views/IndexView.vue')
  },
  {
    path: '/news',
    name: 'news',
    component: () => import(/* webpackChunkName: "about" */ '../views/p01_news.vue')
  },
  {
    path: '/news/newsArticle/:id',
    name: 'newsArticle',
    component: () => import(/* webpackChunkName: "about" */ '../views/p01_newsArticle.vue')
  },
  {
    path: '/teach',
    name: 'teach',
    component: () => import(/* webpackChunkName: "about" */ '../views/p02_teach.vue')
  },
  {
    path: '/reportUrl',
    name: 'reportUrl',
    component: () => import(/* webpackChunkName: "about" */ '../views/p03_reportURL.vue')
  },
  {
    path: '/gov',
    name: 'gov',
    component: () => import(/* webpackChunkName: "about" */ '../views/p04_gov.vue')
  },
  {
    path: '/faq',
    name: 'faq',
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
    path: '/discuss/discuss_content/:article',
    name: 'discuss_content',
    component: () => import(/* webpackChunkName: "about" */ '../views/p06_discuss_content.vue')
  },
  {
    path: '/demoShopping',
    name: 'demoShopping',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoShopping.vue')
  },
  {
    path: '/demoGame',
    name: 'demoGame',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoGame.vue')
  },
  {
    path: '/demoGametest',
    name: 'demoGametest',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoGametest.vue')
  },
  {
    path: '/demoGamep01',
    name: 'demoGamep01',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoGame_p01.vue')
  },
  {
    path: '/demoGamep01test',
    name: 'demoGamep01test',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoGame_p01test.vue')
  },
  {
    path: '/demoGameresult',
    name: 'demoGameresult',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoGame_result.vue'),
    // props: (route) => ({ score: route.params.score })
    
  },
  {
    path: '/demoPhone',
    name: 'demoPhone',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoPhone.vue')
  },
  {
    path: "/demoPhoneBankInput",
    name: "demoPhoneBankInput",
    component: () => import("../components/p07_demoPhoneBankInput.vue"),
  },
  {
    path: "/demoPhoneAnswerPhone",
    name: "demoPhoneAnswerPhone",
    component: () => import("../components/p07_demoPhoneAnswerPhone.vue"),
  },
  {
    path: '/demoLine',
    name: 'demoLine',
    component: () => import(/* webpackChunkName: "about" */ '../views/p07_demoLine.vue')
  },
  {
    path: '/user',
    name: 'user',
    component: () => import(/* webpackChunkName: "about" */ '../views/p08_user.vue')
  },
  {
    path: '/userNotify',
    name: 'userNotify',
    component: () => import(/* webpackChunkName: "about" */ '../views/p08_userNotify.vue')
  },
  {
    path: '/userEditPwd',
    name: 'userEditPwd',
    component: () => import(/* webpackChunkName: "about" */ '../views/p08_userEditPwd.vue')
  },
  {
    path: '/userEdit',
    name: 'userEdit',
    component: () => import(/* webpackChunkName: "about" */ '../views/p08_userEdit.vue')
  },
  {
    path: '/userLogin',
    name: 'userLogin',
    component: () => import(/* webpackChunkName: "about" */ '../views/p08_userLogin.vue')
  },
  {
    path: '/team',
    name: 'team',
    component: () => import(/* webpackChunkName: "about" */ '../views/p09_team.vue')
  },
  {
    path: '/b_login',
    name: 'b_login',
    component: () => import(/* webpackChunkName: "about" */ '../views/b_login.vue')
  },
  {
    path: '/b_index',
    name: 'b_index',
    component: () => import(/* webpackChunkName: "about" */ '../views/b_index.vue')
  },
  {
    path: '/b_data',
    name: 'b_data',
    component: () => import(/* webpackChunkName: "about" */ '../views/b_data.vue')
  },
  {
    path: '/b_updata',
    name: 'b_updata',
    component: () => import(/* webpackChunkName: "about" */ '../views/b_updata.vue')
  },
  {
    path: '/b_settingAccount',
    name: 'b_settingAccount',
    component: () => import(/* webpackChunkName: "about" */ '../views/b_settingAccount.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})


router.beforeEach((to, from, next) => {
    // 讀取 sessionStorage
    const currentStaff = JSON.parse(sessionStorage.getItem('staff')) || {};
    // 檢查 登入的帳號是否為 後台帳號
    const accountTypeId =  currentStaff.account_type_id;
    if ((to.path === '/b_login')) {
        if(currentStaff && (accountTypeId == 2 || accountTypeId == 3)){
            // 若已登入則會跳轉回前後台登入頁面
            next('/');
        } else {
            //若未登如則可以進入後台登入頁面
            next();

        }
    } else if (to.path === '/b_index' || to.path === '/b_data' || to.path === '/b_updata' || to.path === '/b_settingAccount') {
        if(!currentStaff || (accountTypeId != 2 && accountTypeId != 3)){
            // 偵測用戶是否登入後台帳號否的會則會跳轉到登入頁面
            next('/b_login');
        } else {
            //若已登入則會繼續進入下個頁面
            next()
        }
    } else {
        // 以上條件都不符合則繼續造轉至下一頁面
        next()
    }
});

export default router
