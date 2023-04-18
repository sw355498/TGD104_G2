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
                  <userFacebookSignup />
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
                    placeholder="請輸入E-mail作為登入帳號"
                    v-model.trim="account"
                    id="account"
                    required
                  />
                  <label for="password" class="text_title"
                    >密碼/ Password <br
                  /></label>
                  <input
                    class="input_p08_user_login"
                    type="password"
                    placeholder="請輸入6個以上字元的密碼不含空格"
                    v-model.trim="password"
                    id="password"
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
                  />
                  <label class="text_title">密碼/ Password <br /></label>
                  <input
                    class="input_p08_user_login"
                    type="password"
                    placeholder="請輸入6個以上字元的密碼"
                    v-model.trim="passwordLogin"
                  />
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

      active_tab: 0,
      tabs: [
        {
          label: "註冊會員 | Sign up",
          // content: ``,
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
        return;
      }
    },
    handleSubmit() {
      // 將使用者資料放到物件中
      const data = {
        account: this.account,
        password: this.password,
        displayName: this.displayName,
        accountTypeID:  1,
      };

      axios
        .post(`${API_URL}/add_user.php`, data)
        .then((response) => {
          console.log(response.data);
          // 在這裡發送另一個請求以使用剛剛註冊的帳戶登入
          axios
            .post(`${API_URL}/login.php`, {
              email: data.email,
              password: data.password,
            })
            .then((response) => {
              console.log(response.data);
              // 登入成功後，關閉視窗。
              this.$emit("close");
            })
            .catch((error) => {
              console.log(error);
              alert("登入失敗");
            });
        })
        .catch((error) => {
          console.log(error);
          // alert("註冊失敗");
          this.signupFailed = true;
        });
    },
    // 登入
    handleLogin() {
      const data = {
        account: this.accountLogin,
        password: this.passwordLogin,
      };

      axios
        .post(`${API_URL}/login.php`, data)
        .then((response) => {
          // 登入成功後，關閉視窗外還要加會員名稱顯示於nav
          this.$emit("close");
          localStorage.setItem('token', 'loginStatus')
          alert("登入成功");
        })
        .catch((error) => {
          console.error(error);
          // 在這裡處理登入失敗要幹嘛
        });
    },
  },
  computed: {},
};
</script>

<style lang="scss" scoped>
</style>