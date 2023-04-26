<template>
  <div>
          <!-- navgation -->
          <frontNavbar />
  <div class="p08_user">
    <div class="container">
      <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/index">首頁</router-link></li>
            <!-- <li class="breadcrumb-item">
              <a href="javascript:void(0)">會員</a>
            </li> -->
            <li class="breadcrumb-item active" aria-current="page">會員中心</li>
          </ol>
        </nav>
        <!-- /Breadcrumb -->

        <div class="row gutters-sm">
          <div class="col-lg-3 col-md-4 mb-3">
            <div class="card order-1">
              <div class="card-body">
                <!-- 判斷小測驗得到的分數 -->
                 <p class="crown" v-if="member.QUIZ > 70">
                  <i class="fa-solid fa-crown"></i></p>
                <div class="d-flex flex-column align-items-center text-center">
                  <div class="userImg">
                   <img class="w-100 h-100"  :src="pic" alt="userImg" />
                  </div>
                  <!-- <div class="file btn btn-lg btn-primary">
                    Change Photo
                    <input type="file" name="file" />
                  </div> -->
                  <div class="mt-3">
                    <h4 class="mb-2">{{member.NICKNAME}}</h4>
                    <p class="text_title mb-1">{{ memberLevel }}</p>
                    <!-- <p class="text font-size-sm">防詐小尖兵</p> -->
                    <p class="text font-size-sm mb-1" v-if="member.MOBILE !== null">電話:{{member.MOBILE}}</p>
                    <p class="text font-size-sm mb-3" v-if="member.BIRTH !== null ">生日:{{member.BIRTH}}</p>

                    <p class="text_title mb-1">狀態</p>
                    <p class="text font-size-sm crown mb-1" v-if="member.CERTIFIED === 2"><i class="fa-solid fa-circle-check"></i> Email已驗證</p>
                    <p class="text font-size-sm mb-1" v-if="member.CERTIFIED === 1 || !member.CERTIFIED"><i class="fa-solid fa-circle-xmark"></i> Email未驗證</p>
                    <p class="text font-size-sm crown mb-1" v-if="member.QUIZ > 70"><i class="fa-solid fa-circle-check"></i> 通過防詐測驗</p>
                    <p class="text font-size-sm mb-1" v-if="member.QUIZ < 69"><i class="fa-solid fa-circle-xmark"></i> 防詐測驗未通過</p>

                  </div>
                </div>
              </div>
            </div>
            <!-- 等級列表 -->
            <div class="card mt-3 order-6 level">
              <ul class="list-group list-group-flush list-group-dark">
                <li
                  class="list-group-dark list-group-item d-flex flex-column align-items-center flex-wrap"
                >
                  <h5>會員等級列表</h5>
                </li>
                <li
                  class="list-group-dark list-group-item d-flex justify-content-between flex-wrap"
                >
                  <p>LV.1 防詐初學者</p>
                  <span class="text-secondary expText pt-1">exp 0-10</span>
                  <!-- <p class="block mb-1">討論區發文間隔2小時</p> -->
                </li>
                <li
                  class="list-group-dark list-group-item d-flex justify-content-between flex-wrap"
                >
                  <p>LV.2 防詐小尖兵</p>
                  <span class="text-secondary expText pt-1">exp 11-50</span>
                  <!-- <p class="block  mb-1">可換個人大頭貼</p> -->
                </li>
                <li
                  class="list-group-dark list-group-item d-flex justify-content-between flex-wrap"
                >
                  <p>LV.3 防詐達人</p>
                  <span class="text-secondary expText pt-1">exp 51-100</span>
                  <!-- <p class="block mb-1">發文無間隔限制</p> -->
                </li>
                <li
                  class="list-group-dark list-group-item d-flex justify-content-between flex-wrap"
                >
                  <p>LV.4 防詐大師</p>
                  <span class="text-secondary expText pt-1">exp 101-200</span>
                  <!-- <p class="block mb-1">可收藏文章</p> -->
                </li>
                <li
                  class="list-group-dark list-group-item d-flex justify-content-between flex-wrap"
                >
                  <p>LV.5 防詐神人</p>
                  <span class="text-secondary expText pt-1">exp 201-</span>
                  <!-- <p class="block mb-1 justify-content-end">可檢舉文章</p> -->
                </li>
              </ul>
            </div>
            <!--  -->
          </div>
          <div class="col-lg-9 col-md-8 order-2">
            <div class="card mb-3">
              <!-- 會員資訊 -->
              <div class="profile-head">
                <h4>Hello, {{member.NICKNAME}} 歡迎回來</h4>
                <h6>{{ member.ACCOUNT }}</h6>
                <p class="proile-rating">EXP : <span>{{member.EXP}}/200</span></p>
                <div class="progress col-lg-5">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-label="Basic example"
                    :style="{ width: member.EXP + '%'}"
                    :aria-valuenow="member.EXP"
                    aria-valuemin="0"
                    aria-valuemax="999"
                  ></div>
                </div>
              </div>
              <!-- 會員資訊end -->
              <!-- 會員活躍度 -->
              <div class="counter col-lg-7 align-self-lg-end align-self-md-center">
                <div class="row">
                  <div class="col-6 col-lg-3">
                    <!-- <div class="count-data text-center">
                      <h6 class="count h2" data-to="500" data-speed="500">
                        {{LIKEcount}}
                      </h6>
                      <p class="m-0px font-w-600">收到讚數</p>
                    </div> -->
                  </div>
                  <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                      <h6 class="count h2" data-to="150" data-speed="150">
                        {{haveMessage}}
                      </h6>
                      <p class="m-0px font-w-600">收到回應</p>
                    </div>
                  </div>
                  <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                      <h6 class="count h2" data-to="850" data-speed="850">
                        {{MESSAGEcount}}
                      </h6>
                      <p class="m-0px font-w-600">留言次數</p>
                    </div>
                  </div>
                  <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                      <h6 class="count h2" data-to="190" data-speed="190">
                        {{URLcount}}
                      </h6>
                      <p class="m-0px font-w-600">可疑網站回報數</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 會員活躍度end -->
            </div>

            <div class="row">
              <div class="col">
                <div class="card h-100">
                  <div class="card-body">
                    <!-- <div class="d-flex justify-content-between">

                    </div> -->
                    <!-- PO文清單 -->

                    <ul class="nav nav-tabs mt-10" role="tablist">
                      <li class="nav-item" v-for="(tab, tab_index) in tabs" :key="tab_index">
                        <a
                          :class="{
                            'nav-link': true,
                            active: active_tab == tab_index,
                          }"
                          @click="changeTab(tab_index)"
                          ><span class="disIcon"><i :class="tab.icon"></i></span><span class="disText">{{ tab.label }}</span></a
                        >
                      </li>
                    </ul>
                    <!-- tab -->
                    <component :is="tabs[active_tab].component" class="row border-0 "></component>

                    <!-- PO文清單END -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
       <!-- footer -->
       <frontFooter />
</div>
</template>

<script>
import postList from "@/components/userPost.vue";
import replyList from "@/components/userReply.vue";
import collectList from "@/components/userCollect.vue";
import reportList from "@/components/userReport.vue";
import urlList from "@/components/userURL.vue";
// header與footer
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
// 抓會員資料用套件
import axios from "axios";
import { API_URL, reactive } from "@/config";

export default {
  components: {
    postList,
    replyList,
    collectList,
    reportList,
    urlList,
    frontNavbar,
    frontFooter,
  },
  data() {
    return {
      active_tab: 0,
      member: {},
      quizPass: 75,
      expValue: 1,
      URLcount: 0,
      MESSAGEcount: 0,
      LIKEcount: 0,
      haveMessage: 0,
      memberLevel: null,
      levelList: [
        { lv: 'LV.1', name: '防詐初學者', minExp: 0, maxExp: 10 },
        { lv: 'LV.2', name: '防詐小尖兵', minExp: 11, maxExp: 50 },
        { lv: 'LV.3', name: '防詐達人', minExp: 51, maxExp: 100 },
        { lv: 'LV.4', name: '防詐大師', minExp: 101, maxExp: 200 },
        { lv: 'LV.5', name: '防詐神人', minExp: 201, maxExp: 999 }
      ],
      tabs: [
        {
          label: "發文清單",
          component: postList,
          icon: "fa-regular fa-newspaper",
        },
        {
          label: "留言清單",
          component: replyList,
          icon: "fa-regular fa-message",
        },
        {
          label: "可疑網站回報",
          component: urlList,
          icon: "fa-solid fa-bullhorn",
        },
        {
          label: "收藏列表",
          component: collectList,
          icon: "fa-regular fa-bookmark",
        },
        // {
        //   label: "我的檢舉",
        //   component: reportList,
        //   icon: "fa-solid fa-circle-exclamation",
        // },
      ],
      
    };
  },
  
  methods: {
    changeTab(tab_index) {
      this.active_tab = tab_index;
    },
    
  },
  computed: {
    memberLevel() {
      for (let i = 0; i < this.levelList.length; i++) {
        if ( this.expValue >= this.levelList[i].minExp &&  this.expValue <= this.levelList[i].maxExp) {
          return `${this.levelList[i].lv} ${this.levelList[i].name}`;
        }
      }
    }
  },
  mounted() {
   
  const token = localStorage.getItem("token");
  if (token) {
    axios
      .get(`${API_URL}/member_getData.php?token=${token}`)
      .then((response) => {
        this.member = response.data.member[0];
        this.expValue = response.data.member[0].EXP;
        this.quizPass = response.data.member[0].QUIZ;
        this.URLcount = response.data.count;
        this.MESSAGEcount = response.data.countMessage;
        this.LIKEcount = response.data.countLike;
        this.haveMessage = response.data.total_messages;
        this.pic = response.data.member[0].PIC;
    if (response.data.member[0].PIC) {
      // 要require才能正確抓到圖檔路徑
      this.pic = require("@/assets/img/p08_user/" +
        response.data.member[0].PIC);
    } else {
      this.pic = require("@/assets/img/p08_user/user.jpg");
    }

      })
      .catch((error) => {
        console.log(error);
      });
  }
},

created() {
  // 檢查localStorage中是否有token
  if (!localStorage.getItem('token')) {
    this.$router.push('/index');
  }

  // 監控localStorage中token的變化
  window.addEventListener('storage', () => {
    if (!localStorage.getItem('token')) {
      this.$router.push('/index');
    }
  });
}
  
};
</script>
