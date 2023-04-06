<template>
  <button class="backTop_index_btn" @click="scrollToTop">
    <i class="fa-solid fa-angles-left"></i>
  </button>
</template>

<script>
import { ref } from "vue";

export default {
  name: "backTopButton",
  setup() {
    //回到頂端按鈕
    const scrollPosition = ref(0);
    // 監聽頁面的滾動事件
    window.addEventListener("scroll", () => {
      // 設置scrollPosition的值為當前的滾動位置
      scrollPosition.value = window.pageYOffset;
    });

    // 點擊按鈕時滾動回頂部
    const scrollToTop = () => {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    };

    return {
      scrollPosition,
      scrollToTop,
    };
  },
};
</script>
