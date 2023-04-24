<template>
  <div class="account_p07_demoPhone_page">
    <select class="bank">
      <option>(008) 華南商業銀行</option>
    </select>
    <input type="text" class="bankAccount" />
    <input type="text" class="money" />
  </div>
</template>
<script></script>
<style lang="scss" scoped>
@import "../assets/Sass/mixin/mixin";
@import "../assets/Sass/base/breakpoints";
@import "../assets/Sass/base/color";
.account_p07_demoPhone_page {
  width: 100%;
  height: 100%;
  background-image: url("../assets/img/p07_demo/p07_demoPhone/p07_demoPhone_bankAccountPage02.png");
  background-size: cover;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 5;
  @include rwd(md) {
    z-index: 10;
  }
  input,
  select {
    width: 270px;
    height: 36px;
    position: absolute;
    left: calc(50% - 135px);
    font-size: 0.8rem;
    color: #555;
    border: 2px solid #ccc;
    border-radius: 5px;
    padding-left: 10px;
    z-index: 4;
    @include rwd(md) {
      width: 220px;
      left: calc(50% - 110px);
      height: 30px;
    }
  }
  select.bank {
    appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
    top: 278px;
    @include rwd(md) {
      top: 225px;
    }
  }
  input.money {
    bottom: 246px;
    @include rwd(md) {
      bottom: 200px;
    }
  }
  input.bankAccount {
    top: 353px;
    @include rwd(md) {
      top: 285px;
    }
  }
}
</style>
