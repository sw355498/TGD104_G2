<template>
  <transition name="modal">
    <div>
      <div class="modal-wrapper">
        <div class="modal-container" @click.stop>
          <div class="userLogin_modal_header">
            <slot name="header">
              <div class="modal-default-button" @click="$emit('close')">
                <i class="fa-solid fa-xmark h4"></i>
              </div>
            </slot>
          </div>

          <div class="userLogin_modal_body">
            <div id="tabs">
              <div
                v-for="(tab, tab_index) in tabs"
                :class="{ tab: true, active: active_tab == tab_index }"
                @click="changeTab(tab_index)"
                :key="tab_index"
              >
                <div class="tab-label">{{ tab.label }}</div>
              </div>
            </div>

            <hr class="hr_p08_user_login" />
          </div>

          <div class="userLogin_modal_footer">
            <div
              v-for="(tab, tab_index) in tabs"
              :class="{ content: true, active: active_tab == tab_index }"
              :key="tab_index"
            >
              <slot name="footer">
                <div class="div_p08_user_textCenter">【使用以下帳戶連結】</div>

                <div class="div_p08_user_loginType">
                  <!-- FB註冊元件 -->
                  <!-- <userFacebookSignup /> -->
                  <!-- LINE註冊元件 -->
                  <userLineSignup />
                  <!-- Google註冊元件 -->
                  <userGoogleSignup />
                </div>
                <br />
                <div class="div_p08_user_textCenter">【或註冊一個新帳號】</div>

                <form v-if="tab_index === 0" @submit.prevent="handleSubmit">
                  <label for="account" class="text_title"
                    >帳號/ Account <br
                  /></label>
                  <input
                    class="input_p08_user_login"
                    type="email"
                    placeholder="請輸入正確的E-mail作為登入帳號"
                    v-model.trim="account"
                    id="account"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                    required
                  />
                  <label for="password" class="text_title"
                    >密碼/ Password <br
                  /></label>
                  <input
                    class="input_p08_user_login"
                    type="password"
                    placeholder="含英數至少3個字元不含空格"
                    v-model.trim="password"
                    id="password"
                    pattern="^(?=.*[a-zA-Z])(?=.*[0-9]).{3,}$"
                    required
                  />
                  <label for="valid" class="text_title"
                    >再次輸入密碼/ Password <br
                  /></label>
                  <input
                    class="input_p08_user_login"
                    type="password"
                    placeholder="請再次輸入密碼"
                    v-model.trim="confirmPassword"
                    id="valid"
                    @blur="checkPasswordsMatch"
                    pattern="^(?=.*[a-zA-Z])(?=.*[0-9]).{3,}$"
                    required
                  />
                  <!-- 密碼不正確顯示 -->
                  <div v-if="passwordsMatch" class="error_message">
                    密碼不正確
                  </div>
                  <label for="name" class="text_title"
                    >顯示名稱/ Name <br
                  /></label>
                  <input
                    class="input_p08_user_login"
                    type="text"
                    placeholder="請輸入顯示名稱"
                    v-model.trim="displayName"
                    id="name"
                  />
                  <div class="div_p08_user_loginType">
                    <button
                      type="submit"
                      class="medium_button btn_p08_user_loginType"
                    >
                      確定註冊 Sign up
                    </button>
                  </div>
                  <!-- 註冊失敗顯示 -->
                  <div v-if="signupFailed" class="error_signup">註冊失敗</div>
                </form>
                <form v-else @submit.prevent="handleLogin">
                  <label class="text_title">帳號/ Account <br /></label>
                  <input
                    class="input_p08_user_login"
                    type="email"
                    placeholder="請輸入E-mail作為登入帳號"
                    v-model.trim="accountLogin"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                  />
                  <label class="text_title">密碼/ Password <br /></label>
                  <input
                    class="input_p08_user_login"
                    type="password"
                    placeholder="請輸入密碼"
                    v-model.trim="passwordLogin"
                  />
                  <!-- 帳號密碼錯誤 -->
                  <div v-if="signupFailed" class="error_signup">
                    帳號或密碼錯誤
                  </div>
                  <!-- 帳號已被封鎖 -->
                  <div v-if="signupBlock" class="error_signup">
                    帳號已被封鎖
                  </div>
                  <!-- 帳號已被刪除 -->
                  <div v-if="signupCanceled" class="error_signup">
                    帳號已被刪除
                  </div>
                  <div class="div_p08_user_loginType">
                    <button
                      type="submit"
                      class="medium_button btn_p08_user_loginType"
                    >
                      確定登入 Log in
                    </button>
                  </div>
                </form>
              </slot>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-mask" @click="$emit('close')"></div>
    </div>
  </transition>
</template>

<script>
import axios from "axios";
import { API_URL, reactive } from "@/config";
// 第三方註冊元件
import userLineSignup from "./userSignupLine.vue";
import userFacebookSignup from "./userSignupFacebook.vue";
import userGoogleSignup from "./userSignupGoogle.vue";

export default {
  components: {
    userLineSignup,
    userFacebookSignup,
    userGoogleSignup,
  },
  data() {
    return {
      account: "",
      password: "",
      displayName: "",
      // accountTypeID:"",
      passwordsMatch: false,
      signupFailed: false,
      signupBlock:false,
      signupCanceled:false,

      active_tab: 0,
      tabs: [
        {
          label: "註冊會員 | Sign up",
        },

        {
          label: "登入會員 | Log in",
        },
      ],
    };
  },
  methods: {
    changeTab(tab_index) {
      this.active_tab = tab_index;
    },
    close() {
      this.$emit("close");
    },

    // 註冊
    checkPasswordsMatch() {
      if (this.password !== this.confirmPassword) {
        // alert("密碼不正確");
        this.passwordsMatch = true;
        return false;
      } else {
        this.passwordsMatch = false;
        return true;
      }
    },
    handleSubmit() {
      // 將使用者資料放到物件中
      const data = {
        account: this.account,
        password: this.password,
        nickname: this.displayName,
        accountTypeID: 1,
      };

      axios
        .post(`${API_URL}add_user.php`, data)
        .then((response) => {
          console.log(response.data);
          // 在這裡發送另一個請求以使用剛剛註冊的帳戶登入
          if (response.data === "帳號註冊成功") {
            this.signupFailed = false;
            this.$emit("close");
            alert("註冊成功");
            // 登入
            const loginData = {
              account: this.account,
              password: this.password,
              id: "",
            };
            axios
              .post(`${API_URL}login.php`, loginData)
              .then((response) => {
                // 登入成功後，關閉視窗外還要加會員名稱顯示於nav
                this.$emit("close");
                localStorage.setItem("token", response.data.id);
                // 執行登出流程 重新整理頁面
                location.reload();
              })
              .catch((error) => {
                console.log(error.response);
                // 在這裡處理登入失敗要幹嘛
              });

            // 清空欄位
            this.account = "";
            this.password = "";
            this.displayName = "";
            this.confirmPassword = "";
          } else {
            this.signupFailed = true;
          }
        })
        .catch((error) => {
          console.log(error);
          // alert("註冊失敗");
          this.signupFailed = true;
        });
    },
    // 刪除過期的token好像目前還沒有作用
    checkAndClearToken() {
      const currentTime = new Date().getTime(); // 現在的時間戳記
      const tokenExpireTime = localStorage.getItem("tokenExpireTime"); // 將字串轉換為數字
      if (currentTime > tokenExpireTime) {
        // token 已過期，執行登出流程並清除 localStorage 中的 token 資訊
        localStorage.removeItem("token");
        localStorage.removeItem("tokenExpireTime");
        // 執行登出流程 重新整理頁面
        location.reload();
      }
    },
    // 登入
    handleLogin() {
      const data = {
        account: this.accountLogin,
        password: this.passwordLogin,
        id: "",
      };

      axios
        .post(`${API_URL}login.php`, data)
        .then((response) => {
          // 登入成功後，關閉視窗外還要加會員名稱顯示於nav
          this.$emit("close");
          localStorage.setItem("token", response.data.id); //抓會員ID
          // 設定 token 過期時間為 3 小時
          const expireTime = new Date().getTime() + 3 * 60 * 60 * 1000; // 3 小時後的時間戳記
          // const expireTime = new Date().getTime() + (3 * 1000);
          localStorage.setItem("tokenExpireTime", expireTime);

          // 檢查 token 是否過期
          this.checkAndClearToken();
          this.signupFailed = false;
          // token 仍在有效期內，可以進行 API 呼叫等操作
          console.log(response);
          // alert("登入成功");
          // 執行登出流程 重新整理頁面
          location.reload();
        })
        .catch((error) => {
          console.log(error.response);
          // 在這裡處理登入失敗要幹嘛
          // this.signupFailed = true;
          // alert("登入失敗");
          if (error.response.status === 400) {
            // 帳號或密碼錯誤
            console.log("帳號或密碼錯誤");
            this.signupFailed = true;
          } else if (error.response.status === 401) {
            // 帳號被封鎖
            console.log("帳號已被封鎖");
            this.signupBlock = true;
            // alert("帳號已被封鎖");
          } else if (error.response.status === 402) {
            // 帳號被封鎖
            console.log("帳號已被刪除");
            this.signupCanceled = true;
          } else {
            // 其他錯誤
            console.log("登入失敗");
            this.signupFailed = true;
          }
        });
    },
  },
  computed: {},

  watch: {
    // 監聽 localStorage 中的 tokenExpireTime
    "localStorage.tokenExpireTime": function (newVal) {
      this.checkAndClearToken();
    },
  },
};
</script>

<style lang="scss" scoped>
</style>