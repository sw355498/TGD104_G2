<template>
  <button class="medium_button btn_p08_user_loginType" @click="openGoogleLogin">
    <i class="fa-brands fa-google"></i> GOOGLE
  </button>
</template>
  
<script setup>
  import { ref } from 'vue'
  import { API_URL } from "@/config";
  import firebaseConfig from '../firebaseConfig';
  import { getAuth, signInWithPopup, GoogleAuthProvider} from "firebase/auth";
  import axios from 'axios';

  firebaseConfig

  const auth = getAuth();
  const googleProvider = new GoogleAuthProvider();
  const userUid = ref();
  const nickname = ref();
  const accountTypeID = ref();

  function openGoogleLogin(){
    signInWithPopup(auth, googleProvider)
    .then((result) => {
      // console.log('您已登入成功!! 我已取得您的Google名字為: ' + result.user.displayName);
      console.log(result.user.uid);
      userUid.value = result.user.uid;
      nickname.value = result.user.displayName;
      accountTypeID.value = 1;
      axios
        .post(`${API_URL}googleLogin.php`, {
          userUid: userUid.value,
          nickname: nickname.value,
          accountTypeID: accountTypeID.value
        })
        .then((response)=>{
          if(response.data === '登入成功'){
            alert('test');
          }else{
            alert(response.data);
          }
          localStorage.setItem("googleToken", userUid.value);
        })
        .catch((error)=>{
          alert('發生了一些錯誤，請聯絡管理員!')
        })
    })
    .catch((error) => {
      console.log(error.response);
    });
  }


</script>

  