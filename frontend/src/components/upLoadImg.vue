<template>
  <div>
    <!-- <img src="@/assets/img/p08_user/user.jpg" alt="Admin" class="rounded-circle" width="150" /> -->
    <!-- <img
      alt="Admin"
      class="rounded-circle"
      width="150"
      :src="
        imageUrl.PIC
          ? require('@/assets/img/p08_user/' + imageUrl.PIC)
          : require('@/assets/img/p08_user/user.jpg')
      "
    /> -->
    <div class="userImg">
      <img class="w-100 h-100"  :src="pic" alt="userImg" />
    </div>
    <div
      class="file btn btn-lg btn-primary d-flex justify-content-center w-100"
    >
      上傳圖片
      <input id="upload_img" type="file" name="file" @change="picSubmit" />
    </div>
    <!-- <label class="file_btn">
        <input id="upload_img" class="d-none" type="file" @change="picSubmit">
        <i class="fa-solid fa-image fa-fw"></i>上傳圖片<span>{{ ImgName }}</span>
    </label> -->
  </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

import { API_URL } from "@/config";

const fileImage = ref();
const ImgName = ref();

const pic = ref("");
const token = localStorage.getItem("token");
axios
  .get(`${API_URL}/member_getData.php?token=${token}`)
  .then((response) => {
    pic.value = response.data.member[0].PIC;
    if (response.data.member[0].PIC) {
      // 要require才能正確抓到圖檔路徑
      pic.value = require("@/assets/img/p08_user/" +
        response.data.member[0].PIC);
    } else {
      pic.value = require("@/assets/img/p08_user/user.jpg");
    }
    console.log(pic.value);
  })
  .catch((error) => {
    console.log(error);
  });

function picSubmit(event) {
  fileImage.value = event.target.files[0];
  ImgName.value = `: ${fileImage.value.name}`;

  // 封裝成 FormData 的形式傳給後端處理資料
  const form = new FormData();
  console.log(localStorage.getItem("token"));
  form.append("userId", localStorage.getItem("token"));
  form.append("newImage", fileImage.value);
  // 抓圖片

  axios
    .post(`${API_URL}member_changePic.php`, form)
    .then((response) => {
      // alert(response.data.message);
      // 重新整理頁面
      location.reload();
    })
    .catch((err) =>
      alert(
        `發生了某些連線錯誤，請聯繫技術人員! 錯誤訊息: ${err.response.data}`
      )
    );
}
</script>