<template>
  <button class="medium_button btn_p08_user_loginType" @click="openGoogleLogin">
    <i class="fa-brands fa-google"></i> GOOGLE
  </button>
</template>
  
<script setup>
  import firebaseConfig from '../firebaseConfig';
  import { getAuth, signInWithPopup, GoogleAuthProvider} from "firebase/auth";

  firebaseConfig

  const auth = getAuth();
  const googleProvider = new GoogleAuthProvider();

  function openGoogleLogin(){
    signInWithPopup(auth, googleProvider).then((result) => {
      console.log('您已登入成功!! 我已取得您的Google名字為: ' + result.user.displayName);
    }).catch((error) => {
      console.log(error);
    });
  }


</script>

  