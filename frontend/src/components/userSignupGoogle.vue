<template>
  <button class="medium_button btn_p08_user_loginType" @click="openGoogleLogin">
    <i class="fa-brands fa-google"></i> GOOGLE
  </button>
</template>
  
<script setup>
  import axios from 'axios';

  const CLIENT_ID = '340832260-j816tlp4s7ff5d49kcicn8uj219fi3gn.apps.googleusercontent.com';
  const API_KEY = 'AIzaSyA-zgpR3XTUYHPobIMMY-Ij4PLfWpcafSQ';

  function openGoogleLogin() {
    const width = 600;
    const height = 800;
    const left = (window.innerWidth - width) / 2;
    const top = (window.innerHeight - height) / 2;

    const url = `https://accounts.google.com/o/oauth2/auth?client_id=${CLIENT_ID}&redirect_uri=http://localhost:8080/index&response_type=code&scope=email%20profile&access_type=offline&prompt=consent`;

    const features = `width=${width},height=${height},left=${left},top=${top}`;

    window.location.href = url;
    // window.open(url, 'Google Login', features);
    
  }

  // 在接收到授權碼之後，可以使用以下程式碼向 Google API 發出請求以獲取使用者的資訊
  async function getUserInfo(authorizationCode) {
    const response = await axios.post('https://oauth2.googleapis.com/token', {
      code: authorizationCode,
      client_id: CLIENT_ID,
      client_secret: API_KEY,
      redirect_uri: 'http://localhost:8080/index',
      grant_type: 'authorization_code'
    });

    const userInfoResponse = await axios.get(`https://www.googleapis.com/oauth2/v1/userinfo?access_token=${response.data.access_token}`);
    const userInfo = userInfoResponse.data;

    // console.log(userInfoResponse);
  }

  // 在 url 中檢查是否包含授權碼，如果有，使用 getUserInfo 函數來獲取使用者資訊
  if (window.location.search.includes('?code=')) {
    const authorizationCode = window.location.search.split('?code=')[1];
    getUserInfo(authorizationCode);
  }
  
</script>

  