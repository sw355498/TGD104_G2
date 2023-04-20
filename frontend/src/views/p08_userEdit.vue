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
              <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
              <li class="breadcrumb-item">
                <router-link to="/p08_user">會員中心</router-link>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                編輯會員資料
              </li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card order-1">
                <div class="card-body">
                  <!-- 判斷小測驗得到的分數 -->
                  <p class="crown" v-if="member.QUIZ > 70">
                    <i class="fa-solid fa-crown"></i>
                  </p>
                  <div
                    class="d-flex flex-column align-items-center text-center"
                  >
                    <img
                      src="../assets/img/p08_user/user.jpg"
                      alt="Admin"
                      class="rounded-circle"
                      width="150"
                    />
                    <div class="file btn btn-lg btn-primary">
                      上傳圖片
                      <input type="file" name="file" />
                    </div>
                    <div class="mt-3">
                      <h4 class="mb-2">{{ member.NICKNAME }}</h4>
                      <p class="text_title mb-1">{{ memberLevel }}</p>
                      <!-- <p class="text font-size-sm">防詐小尖兵</p> -->
                      <p
                        class="text font-size-sm mb-1"
                        v-if="member.MOBILE !== null"
                      >
                        電話:{{ member.MOBILE }}
                      </p>
                      <p
                        class="text font-size-sm mb-3"
                        v-if="member.MOBILE !== null"
                      >
                        生日:{{ member.BIRTH }}
                      </p>

                      <p class="text_title mb-1">狀態</p>
                      <p
                        class="text font-size-sm crown mb-1"
                        v-if="member.CERTIFIED === 2"
                      >
                        <i class="fa-solid fa-circle-check"></i> Email已驗證
                      </p>
                      <p
                        class="text font-size-sm mb-1"
                        v-if="member.CERTIFIED === 1 || !member.CERTIFIED"
                      >
                        <i class="fa-solid fa-circle-xmark"></i> Email未驗證
                      </p>
                      <p
                        class="text font-size-sm crown mb-1"
                        v-if="member.QUIZ > 70"
                      >
                        <i class="fa-solid fa-circle-check"></i> 通過防詐測驗
                      </p>
                      <p class="text font-size-sm mb-1" v-if="member.QUIZ < 69">
                        <i class="fa-solid fa-circle-xmark"></i> 防詐測驗未通過
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-8 order-2 profile-head">
              <h4>編輯會員資料</h4>
              <h6>{{ member.ACCOUNT }}</h6>

              <div class="row mt-4">
                <!-- FORM -->
                <form @submit.prevent="handleSubmit">
                  <div class="col-lg-6 margin-10 col-sm-12">
                    <label for="">顯示名稱</label>
                    <input
                      type="text"
                      class="input_p08_user_login"
                      :placeholder="member.NICKNAME"
                      v-model.trim="displayName"
                      id="displayName"
                    />

                    <label for="">電話</label>
                    <input
                      type="text"
                      class="input_p08_user_login"
                      :placeholder="member.MOBILE"
                      v-model.trim="phoneNumber"
                      id="phoneNumber"
                    />

                    <label for="">生日</label>
                    <input
                      type="date"
                      class="input_p08_user_login"
                      :value="birthday"
                      placeholder="MM/DD/YYYY"
                      onfocus="(this.type='date')"
                      onblur="(this.type='text')"
                      id="birthday"
                    />
                    <button type="submit" class="btn btn-primary">儲存</button>
                    <button class="btn">
                      <router-link to="/p08_user">取消</router-link>
                    </button>
                  </div>
                </form>
                <!-- FORM -->
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
import frontNavbar from "@/components/f_nav.vue";
import frontFooter from "@/components/f_footer.vue";
// 抓會員資料用套件
import axios from "axios";
import { API_URL, reactive } from "@/config";

export default {
  components: {
    frontNavbar,
    frontFooter,
  },
  data() {
    return {
      member: {},
      displayName: "",
      phoneNumber: "",
      birthday: "",
      expValue: 1,
      memberLevel: null,
      levelList: [
        { lv: "LV.1", name: "防詐初學者", minExp: 0, maxExp: 10 },
        { lv: "LV.2", name: "防詐小尖兵", minExp: 11, maxExp: 50 },
        { lv: "LV.3", name: "防詐達人", minExp: 51, maxExp: 100 },
        { lv: "LV.4", name: "防詐大師", minExp: 101, maxExp: 200 },
        { lv: "LV.5", name: "防詐神人", minExp: 201, maxExp: 999 },
      ],
    };
  },
  computed: {
    memberLevel() {
      for (let i = 0; i < this.levelList.length; i++) {
        if (
          this.expValue >= this.levelList[i].minExp &&
          this.expValue <= this.levelList[i].maxExp
        ) {
          return `${this.levelList[i].lv} ${this.levelList[i].name}`;
        }
      }
    },
  },
  // 顯示會員資料
  mounted() {
    const token = localStorage.getItem("token");
    if (token) {
      axios
        .get(`${API_URL}/member_getData.php?token=${token}`)
        .then((response) => {
          this.member = response.data;
          this.expValue = response.data.EXP;
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },
  methods: {
    handleSubmit() {
      // 建立要傳送的資料物件
      const data = {
        displayName: this.displayName,
        phoneNumber: this.phoneNumber,
        birthday: this.birthday,
      };

      // 使用axios套件發送POST請求
      axios
        .post(`${API_URL}/member_update.php`, data)
        .then((response) => {
          // 處理回應結果
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    // 檢查localStorage中是否有token
    if (!localStorage.getItem("token")) {
      this.$router.push("/index");
    }

    // 監控localStorage中token的變化
    window.addEventListener("storage", () => {
      if (!localStorage.getItem("token")) {
        this.$router.push("/index");
      }
    });
  },
};
</script>