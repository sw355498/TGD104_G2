<template>
  <button class="medium_button btn_p08_user_loginType" id="lineLoginBtn" @click="openLineLogin">
    <i class="fa-brands fa-line"></i> LINE
  </button>
</template>

<script setup>

  // LINE 登入
  function openLineLogin(response) {
    let client_id = '1660893613';
    let redirect_uri = 'https://tibamef2e.com/tgd104/g2/index';
    let link = 'https://access.line.me/oauth2/v2.1/authorize?';
    link += 'response_type=code';
    link += '&client_id=' + client_id;
    link += '&redirect_uri=' + redirect_uri;
    link += '&state=login';
    link += '&scope=openid%20profile';
    window.location.href = link;
    console.log('ok');
  };
  
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const code = urlParams.get('code');

  $.ajax({
    url: 'https://api.line.me/oauth2/v2.1/token',
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    data: {
      grant_type: 'authorization_code',
      code: code,
      redirect_uri: 'https://tibamef2e.com/tgd104/g2/index',
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
          const userId = response.sub;
          const name = response.name;
          const pictureUrl = response.picture;

          // 在此處處理使用者資訊
          // console.log(userId, name, pictureUrl);
          console.log(response);
        }
      });
    }
  });
</script>
