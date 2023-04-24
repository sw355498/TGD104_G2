<template>
  <div class="loading_layout">
    <div class="d-flex justify-content-center align-items-center load_block">
      <svg width="360" height="360" style="">
        <use xlink:href="#load" />
      </svg>
    </div>
    <div class="container load_block">
      <span class="spinner spinner--quarter"></span>
    </div>
  </div>
</template>
<script></script>
<style lang="scss">
@import "../assets/Sass/base/color";
.loading_layout {
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: $background_color;
  z-index: 1000;
}
.load_block {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 999;
}

/* Box Container */
.container {
  margin: 0 auto;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Keyframes Spin */
@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

/* Spinner */
.spinner {
  aspect-ratio: 1/1;
  border-radius: 50%;
  animation: spin infinite linear;
}

.spinner--quarter {
  width: 120px;
  border: 3px solid #0fb2f2;
  border-top-color: transparent;
  animation-duration: 1s;
}
</style>
