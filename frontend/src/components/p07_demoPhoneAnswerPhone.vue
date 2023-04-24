<template>
  <div class="answer_p07_demoPhone_page">
    <div class="slideBtn">
      <div class="dragBtn">
        <i class="fa-solid fa-phone"></i>
      </div>
      <span>滑動來接聽</span>
      <div class="dragArrived"></div>
    </div>
  </div>
</template>

<script setup>
// import Hammer from "hammerjs";

const dragBtn = document.querySelector(".dragBtn");
// const hummerDrag = new hummer(dragBtn);
// hummerDrag.on("pan", (e) => {
//   console.log(e);
// });
</script>

<style lang="scss" scoped>
@import "../assets/Sass/mixin/mixin";
@import "../assets/Sass/base/breakpoints";
@import "../assets/Sass/base/color";
.answer_p07_demoPhone_page {
  width: 100%;
  height: 100%;
  background-image: url("../assets/img/p07_demo/p07_demoPhone/p07_demoPhone_bankAccountPage00.png");
  background-size: cover;
  position: absolute;
  top: 0;
  left: 0;
  .slideBtn {
    position: absolute;
    z-index: 4;
    bottom: 90px;
    left: calc(50% - 125px);
    width: 250px;
    height: 76px;
    border-radius: 76px;
    text-align: center;
    background-color: #ffffff22;
    @include rwd(md) {
      width: 240px;
      height: 60px;
      left: calc(50% - 120px);
    }
    .dragBtn {
      position: absolute;
      z-index: 2;
      top: 2px;
      left: 2px; //178px
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background-color: $text_color;
      display: flex;
      justify-content: center;
      align-items: center;
      i {
        font-size: 1.5rem;
        color: green;
      }
      @include rwd(md) {
        width: 55px;
        height: 55px;
      }
    }
    .dragArrived {
      position: absolute;
      top: 2px;
      left: 178px;
      width: 72px;
      height: 72px;
      z-index: 2;
      background-color: transparent;
      @include rwd(md) {
        width: 55px;
        height: 55px;
        left: 181px;
      }
    }
    span {
      line-height: 76px;
      margin-left: 30px;
      @include rwd(md) {
        line-height: 60px;
        font-size: 14px;
      }
    }
  }
}
</style>
