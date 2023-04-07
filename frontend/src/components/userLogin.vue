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

                 <p v-if="tab_index === 0">
                  <label for="account" class="text_title">帳號/ Account <br /></label>
                  <input class="input_p08_user_login" type="text" placeholder="請輸入E-mail作為登入帳號" v-model="accountValue" id="account">
                  <label for="password" class="text_title">密碼/ Password <br /></label>
                  <input class="input_p08_user_login" type="text" placeholder="請輸入6個以上字元的密碼" v-model="passwordValue" id="password">
                  <label for="valid" class="text_title">再次輸入密碼/ Password <br /></label>
                  <input class="input_p08_user_login" type="text" placeholder="請再次輸入密碼" v-model="confirmPasswordValue" id="valid">
                  <label for="name" class="text_title">顯示名稱/ Name <br /></label>
                  <input class="input_p08_user_login" type="text" placeholder="請輸入顯示名稱" v-model="displayNameValue" id="name">
                  <div class="div_p08_user_loginType">
                  <button class="medium_button btn_p08_user_loginType" @click="handleSubmit">確定註冊 Sign up</button>
                  </div>
                </p>
                <p v-else>
                  <label class="text_title">帳號/ Account <br /></label>
                  <input class="input_p08_user_login" type="text" placeholder="請輸入E-mail作為登入帳號" />
                  <label class="text_title">密碼/ Password <br /></label>
                  <input class="input_p08_user_login" type="text" placeholder="請輸入6個以上字元的密碼" />
                  <div class="div_p08_user_loginType">
                  <button class="medium_button btn_p08_user_loginType">確定登入 Log in</button>
                  </div>
                </p>
         
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
export default {

  data() {
    return {
      active_tab: 0,
      tabs: [
        {
          label: "註冊會員 | Sign up",
          content: ``,
          props: {

            accountTitle: {
              type: String,
              default: "Account / 帳號",
              validate: "required"
            },
            accountType: {
              type: String,
              default: "text",
            },
            passwordTitle: {
              type: String,
              default: "Password / 密碼",
            },
            displayNameTitle: {
              type: String,
              default: "顯示名稱",
            },

          },
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
    // handleSubmit(){
    //   console.log(
    //   this.accountValue,
    //     this.passwordValue,
    //     this.confirmPasswordValue,
    //     this.displayNameValue,);
    // },

}
};

</script>

<style lang="scss" scoped>
</style>