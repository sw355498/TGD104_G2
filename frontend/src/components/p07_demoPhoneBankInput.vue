<template>
  <div class="account_p07_demoPhone_page">
    <select class="bank">
      <option>(822) 中國信託商業</option>
    </select>
    <input type="text" class="bankAccount" />
    <input type="text" class="money" />
  </div>
</template>
<script></script>
<style lang="scss" scoped>
.account_p07_demoPhone_page {
  width: 350px;
  height: 711px;
  background-image: url("../assets/img/p07_demo/p07_demoPhone/p07_demoPhone_bankAccountPage02.png");
  position: relative;
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
  }
  select.bank {
    appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
    top: 280px;
  }
  input.money {
    bottom: 245px;
  }
  input.bankAccount {
    top: 355px;
  }
}
</style>
