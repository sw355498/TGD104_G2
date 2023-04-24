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
          if(response.data.message === '登入成功'){
            alert(response.data.message);
          }else{
            alert(response.data.message);
          }
          localStorage.setItem("token", response.data.id);
          window.location.reload();
        })
        .catch((error)=>{
          alert('發生了一些錯誤，請聯絡管理員!')
          window.location.reload();
        })
    })
    .catch((error) => {
      console.log(error.response);
    });
  }


</script>

  