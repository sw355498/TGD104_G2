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
                  <button class="medium_button btn_p08_user_loginType">
                    <i class="fa-brands fa-facebook"></i> FB
                  </button>
                  <button class="medium_button btn_p08_user_loginType">
                    <i class="fa-brands fa-line"></i> LINE
                  </button>
                  <button class="medium_button btn_p08_user_loginType">
                    <i class="fa-brands fa-google"></i> GOOGLE
                  </button>
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
                    required
                  />
                  <div v-if="passwordsMatch" class="error_message">
                    密碼不匹配
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
                    required
                  />
                  <div class="div_p08_user_loginType">
                    <button
                      type="submit"
                      class="medium_button btn_p08_user_loginType"
                    >
                      確定註冊 Sign up
                    </button>
                  </div>
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

export default {
  data() {
    return {
      account: "",
      password: "",
      displayName: "",

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
    handleSubmit() {
      if (this.password !== this.confirmPassword) {
        alert("密碼不匹配");
        return;
      }

      // 將使用者資料放到物件中
      const data = {
        account: this.account,
        password: this.password,
        displayName: this.displayName,
      };

      axios
        .post(`${API_URL}/signup.php`, data)
        .then((response) => {
          // 註冊成功要幹嘛
          console.log(response.data);
        })
        .catch((error) => {
          // 註冊錯誤要幹嘛
          console.error(error);
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
        console.log(response.data);
        // 在這裡處理登入成功要幹嘛
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