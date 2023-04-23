<template>
  <div class="answer_p07_demoPhone_page">
    <div class="slideBtn">
      <div class="dragBtn"><i class="fa-solid fa-phone"></i></div>
      <span>滑動來接聽</span>
      <div class="dragArrived"></div>
    </div>
  </div>
</template>
<script setup></script>
<style lang="scss" scoped>
.answer_p07_demoPhone_page {
  width: 350px;
  height: 711px;
  background-image: url("../assets/img/p07_demo/p07_demoPhone/p07_demoPhone_bankAccountPage00.png");
  position: relative;
  .slideBtn {
    position: absolute;
    z-index: 2;
    bottom: 90px;
    left: calc(50% - 125px);
    width: 250px;
    height: 76px;
    border-radius: 76px;
    text-align: center;
    background-color: #ffffff22;
    .dragBtn {
      position: absolute;
      z-index: 2;
      top: 2px;
      left: 2px; //178px
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background-color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      i {
        font-size: 1.5rem;
        color: green;
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
    }
    span {
      line-height: 76px;
      margin-left: 30px;
    }
  }
}
</style>
