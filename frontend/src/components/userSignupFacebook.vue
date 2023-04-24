<template>
  <button class="medium_button btn_p08_user_loginType" @click="openFacebookLogin">
    <i class="fa-brands fa-facebook"></i> FB
  </button>
</template>
  
<script setup>
import { onMounted } from 'vue';
// function openFacebookLogin(){
//   console.log('ok');
// }

// facebook 登入
function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
  console.log('statusChangeCallback');
  // console.log(response);                   // The current login status of the person.
  if (response.status === 'connected') {   // Logged into your webpage and Facebook.
    testAPI();  
  } else {                                 // Not logged into your webpage or we are unable to tell.
    // document.getElementById('status').innerHTML = 'Please log ' +
    //   'into this webpage.';
  }
}


function openFacebookLogin() {               // Called when a person is finished with the Login Button.
  FB.getLoginStatus(function(response) {   // See the onlogin handler
    statusChangeCallback(response);
  });
}


window.fbAsyncInit = function() {
  FB.init({
    appId      : '736579044869963',
    cookie     : true,                     // Enable cookies to allow the server to access the session.
    xfbml      : true,                     // Parse social plugins on this webpage.
    version    : 'v16.0'           // Use this Graph API version for this call.
  });


  FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
    statusChangeCallback(response);        // Returns the login status.
  });
};

function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
  console.log('Welcome!  Fetching your information.... ');
  FB.api('/me?fields=email, name, picture', function(response) {
    // console.log(response);
    // document.getElementById('status').innerHTML =
    //   'Thanks for logging in, ' + response.name + '!';
  });
}

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

onMounted(()=>{
  
})

</script>
  