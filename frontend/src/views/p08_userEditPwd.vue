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
                <router-link to="/user">會員中心</router-link>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                修改密碼
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
                    <!-- <div class="file btn btn-lg btn-primary">
                      上傳圖片
                      <input type="file" name="file" />
                    </div> -->
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
                        v-if="member.BIRTH !== null"
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
              <h4>修改密碼</h4>
              <h6>{{ member.ACCOUNT }}</h6>

              <div class="row mt-4">
                <!-- FORM -->
                <form @submit.prevent="handleSubmit">
                  <div class="col-lg-6 margin-10 col-sm-12">
                    <label for="old-password">舊密碼</label>
                    <input
                      id="old-password"
                      type="password"
                      class="input_p08_user_login"
                      v-model="oldPassword"
                      required
                    />

                    <label for="new-password">新密碼</label>
                    <input
                      id="new-password"
                      type="password"
                      class="input_p08_user_login"
                      v-model="newPassword"
                      required
                    />

                    <label for="confirm-password">確認密碼</label>
                    <input
                      id="confirm-password"
                      type="password"
                      class="input_p08_user_login"
                      v-model="confirmPassword"
                      @blur="checkPasswordsMatch"
                      required
                    />
                    <!-- 密碼不正確顯示 -->
                    <div v-if="passwordsMatch" class="error_message">
                      密碼不正確
                    </div>
                    <button type="submit" class="btn btn-primary">儲存</button>
                    <button class="btn">
                      <router-link to="/user">取消</router-link>
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
      oldPassword: "",
      newPassword: "",
      confirmPassword: "",
      passwordsMatch: false,
    };
  },
  mounted() {
    const token = localStorage.getItem("token");
    if (token) {
      axios
        .get(`${API_URL}/member_getData.php?token=${token}`)
        .then((response) => {
          this.member = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },
  methods: {
    checkPasswordsMatch() {
      if (this.newPassword !== this.confirmPassword) {
        this.passwordsMatch = true;
        return false;
      } else {
        this.passwordsMatch = false;
        return true;
      }
    },
    handleSubmit() {
      if (this.newPassword !== this.confirmPassword) {
        alert("密碼正確");
        return;
      }
      const data = {
        token: localStorage.getItem("token"),
        oldPassword: this.oldPassword,
        newPassword: this.newPassword,
      };
      axios
        .post(`${API_URL}/member_changePassword.php`, data)
        .then((response) => {
          console.log(response.data);
          alert("修改成功");
          this.$router.push("/user");
        })
        .catch((error) => {
          console.log(error);
          alert("修改失敗");
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