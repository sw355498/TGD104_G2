<template>
  <div class="p08_user">
    <div class="container">
      <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
            <!-- <li class="breadcrumb-item">
              <a href="javascript:void(0)">會員</a>
            </li> -->
            <li class="breadcrumb-item active" aria-current="page">會員中心</li>
          </ol>
        </nav>
        <!-- /Breadcrumb -->

        <div class="row gutters-sm">
          <div class="col-md-4 mb-3">
            <div class="card order-1">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img
                    src="../assets/img/p08_user/user.jpg"
                    alt="Admin"
                    class="rounded-circle"
                    width="150"
                  />
                  <div class="file btn btn-lg btn-primary">
                    Change Photo
                    <input type="file" name="file" />
                  </div>
                  <div class="mt-3">
                    <h4 class="">Karen</h4>
                    <p class="text_title mb-1">LV.2</p>
                    <p class="text font-size-sm">防詐小尖兵</p>
                    <p class="text font-size-sm">加入時間:yyyy/mm</p>

                    <p class="text_title mb-1">狀態</p>
                    <p class="text font-size-sm">Email 驗證</p>
                    <p class="text font-size-sm">防詐小達人</p>

                  </div>
                </div>
              </div>
            </div>
            <!-- 等級列表 -->
            <div class="card mt-3 order-6 level">
              <ul class="list-group list-group-flush list-group-dark">
                <li
                  class="list-group-dark list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h5>會員等級列表</h5>
                </li>
                <li
                  class="list-group-dark list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h6>LV.0 防詐初學者</h6>
                  <span class="text-secondary">exp 0-10</span>
                  <p class="block">討論區發文間隔2小時</p>
                </li>
                <li
                  class="list-group-dark list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h6>LV.1 防詐小尖兵</h6>
                  <span class="text-secondary">exp 11-50</span>
                  <p class="block">可換個人大頭貼</p>
                </li>
                <li
                  class="list-group-dark list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h6>LV.2 防詐達人</h6>
                  <span class="text-secondary">exp 51-100</span>
                  <p class="block">發文無間隔限制</p>
                </li>
                <li
                  class="list-group-dark list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h6>LV.3 防詐大師</h6>
                  <span class="text-secondary">exp 101-200</span>
                  <p class="block">可收藏文章</p>
                </li>
                <li
                  class="list-group-dark list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h6>LV.4 防詐神人</h6>
                  <span class="text-secondary">exp 201-</span>
                  <p class="block">可檢舉文章</p>
                </li>
              </ul>
            </div>
            <!--  -->
          </div>
          <div class="col-md-8 order-2">
            <div class="card mb-3">
              <!-- 會員資訊 -->
              <div class="profile-head">
                <h4>Hello, Karen 歡迎回來</h4>
                <h6>karen@gmail.com</h6>
                <p class="proile-rating">EXP : <span>50/100</span></p>
                <div class="progress col-lg-5">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-label="Basic example"
                    style="width: 50%"
                    aria-valuenow="50"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <!-- 會員資訊end -->
              <!-- 會員活躍度 -->
              <div class="counter col-lg-6 align-self-end">
                <div class="row">
                  <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                      <h6 class="count h2" data-to="500" data-speed="500">
                        500
                      </h6>
                      <p class="m-0px font-w-600">收到讚數</p>
                    </div>
                  </div>
                  <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                      <h6 class="count h2" data-to="150" data-speed="150">
                        150
                      </h6>
                      <p class="m-0px font-w-600">收到回應</p>
                    </div>
                  </div>
                  <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                      <h6 class="count h2" data-to="850" data-speed="850">
                        850
                      </h6>
                      <p class="m-0px font-w-600">留言次數</p>
                    </div>
                  </div>
                  <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                      <h6 class="count h2" data-to="190" data-speed="190">
                        190
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
                    <div class="d-flex justify-content-between">
                      <div class="col-md-3">
                        <select
                          class="form-select form-select-sm"
                          aria-label=".form-select-sm example"
                        >
                          <option selected>主題分類</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </select>
                      </div>

                      <div class="col-md-3">
                        <select
                          class="form-select form-select-sm"
                          aria-label=".form-select-sm example"
                        >
                          <option selected>排序方式</option>
                          <option value="1">日期新到舊</option>
                          <option value="2">回應多到少</option>
                          <option value="3">讚數多到少</option>
                        </select>
                      </div>
                    </div>
                    <!-- PO文清單 -->

                    <!-- tab -->
                    <!-- <div id="tabs">
                      <div
                        v-for="(tab, tab_index) in tabs"
                        :class="{ tab: true, active: active_tab == tab_index }"
                        @click="changeTab(tab_index)"
                      >
                        <div class="tab-label h5">{{ tab.label }}</div>
                      </div>
                    </div>
                    <div
                      v-for="(tab, tab_index) in tabs"
                      :class="{
                        content: true,
                        active: active_tab == tab_index,
                      }"
                    ></div> -->

                    <ul class="nav nav-tabs mt-10" role="tablist">
                      <li class="nav-item" v-for="(tab, tab_index) in tabs">
                        <a
                          :class="{
                            'nav-link': true,
                            active: active_tab == tab_index,
                          }"
                          @click="changeTab(tab_index)"
                          >{{ tab.label }}</a
                        >
                      </li>
                    </ul>
                    <!-- tab -->
                    <component :is="tabs[active_tab].component"></component>

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
</template>

<script>
import postList from "@/components/userPost.vue";
import replyList from "@/components/userReply.vue";

export default {
  components: {
    postList,
    replyList,
  },
  data() {
    return {
      active_tab: 0,
      tabs: [
        {
          label: "發文清單",
          component: postList,
        },
        {
          label: "留言清單",
          component: replyList,
        },
        {
          label: "可疑網站回報",
          content: "Content 3",
        },
        {
          label: "收藏列表",
          content: "Content 3",
        },
        {
          label: "我的檢舉",
          content: "Content 3",
        },
      ],
    };
  },

  methods: {
    changeTab(tab_index) {
      this.active_tab = tab_index;
    },
  },
};
</script>
