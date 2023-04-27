<template>
  <button class="medium_button btn_p08_user_loginType" id="lineLoginBtn" @click="openLineLogin">
    <i class="fa-brands fa-line"></i> LINE
  </button>
</template>

<script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  import { API_URL } from "@/config";

  // LINE 登入
  function openLineLogin(response) {
    let client_id = '1660893613';
    let redirect_uri = 'http://localhost:8080/index';
    let link = 'https://access.line.me/oauth2/v2.1/authorize?';
    link += 'response_type=code';
    link += '&client_id=' + client_id;
    link += '&redirect_uri=' + redirect_uri;
    link += '&state=login';
    link += '&scope=openid%20profile';
    window.location.href = link;
  };
  
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const qs = require('qs');
  const accessToken = ref();
  const expiresIn = ref();
  const idToken = ref();
  const code = urlParams.get('code');
  const userId = ref();
  const nickname = ref();
  const accountTypeID = ref();
  
  $.ajax({
    url: 'https://api.line.me/oauth2/v2.1/token',
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    data: {
      grant_type: 'authorization_code',
      code: code,
      redirect_uri: 'http://localhost:8080/index',
      client_id: '1660893613',
      client_secret: 'dd30d5f42bc1a0e89a1eb27679c5a488'
    },
    success: function(response) {
      const accessToken = response.access_token;
      const expiresIn = response.expires_in;
      const idToken = response.id_token;

      // 使用idToken從LINE API獲取使用者資訊
      $.ajax({
        url: 'https://api.line.me/oauth2/v2.1/verify',
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'Authorization': 'Bearer ' + accessToken
        },
        data: {
          id_token: idToken,
          client_id: '1660893613'
        },
        success: function(response) {
          userId.value = response.sub;
          nickname.value = response.name;
          accountTypeID.value = 1;
          console.log(response.data);

          // 在此處處理使用者資訊
          console.log(userId.value, nickname.value, accountTypeID.value);

          axios
          .post(`${API_URL}lineLogin.php`, {
            userId: userId.value,
            nickname: nickname.value,
            accountTypeID: accountTypeID.value
          })
          .then((response)=>{
            if(response.data.message === '登入成功'){
              // alert(response.data.message);
            }else{
              alert(response.data.message);
            }
            localStorage.setItem("token", response.data.id);
            window.location.reload(); 
          })
          .catch((error)=>{
            alert('發生了一些錯誤，請聯絡管理員!')
          })
        },
        error: function(error){
          console.log(error);
        }
      });
    }
  });

  // axios({
  //   method: 'post',
  //   url: 'https://api.line.me/oauth2/v2.1/token',
  //   headers: {
  //     'Content-Type': 'application/x-www-form-urlencoded'
  //   },
  //   data: qs.stringify({
  //     grant_type: 'authorization_code',
  //     code: code,
  //     redirect_uri: 'https://tibamef2e.com/tgd104/g2/index',
  //     client_id: '1660893613',
  //     client_secret: 'dd30d5f42bc1a0e89a1eb27679c5a488'
  //   })
  // })
  // .then((response)=>{
  //   accessToken.value = response.data.access_token;
  //   expiresIn.value = response.data.expires_in;
  //   idToken.value = response.data.id_token;

  //   // 使用獲得的idToken取得使用者資訊
  //   axios({
  //     metod: 'post',
  //     url: 'https://api.line.me/oauth2/v2.1/verify',
  //     headers: {
  //       'Content-Type': 'application/x-www-form-urlencoded',
  //       'Authorization': 'Bearer ' + accessToken.value
  //     },
  //     data: qs.stringify({
  //       id_token: idToken.value,
  //       client_id: '1660893613'
  //     })
  //   })
  //   .then((response)=>{
  //     userId.value = response.data.sub;
  //     nickname.value = response.data.name;
  //     accountTypeID.value = 1;
  //     axios
  //     .post(`${API_URL}lineLogin.php`, {
  //       userId: userId.value,
  //       nickname: nickname.value,
  //       accountTypeID: accountTypeID.value
  //     })
  //     .then((response)=>{
  //       if(response.data === '登入成功'){
  //         alert('test');
  //       }else{
  //         alert(response.data);
  //       }
  //       // localStorage.setItem("token", userId.value);
  //     })
  //     .catch((error)=>{
  //       alert('發生了一些錯誤，請聯絡管理員!')
  //     })
  //   })
  //   .catch((error)=>{
  //     console.log(error);
  //   })

  // })

</script>
