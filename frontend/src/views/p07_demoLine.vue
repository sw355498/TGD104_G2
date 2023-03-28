<template>
  <div class="body_p07_demoLine">
    <!-- demo 體驗的 nav -->
    <p07_demo_nav />
    <section class="main_p07_demoLine">
      <!-- line 背景 -->
      <div class="Line_p07_demoLine">
        <img src="../assets/img/p07_demo/p07_demoLine/linebg.png" alt="Line">
      </div>
      <!-- 筆 -->
      <div class="applepencil_p07_demoLine">
        <img src="../assets/img/p07_demo/p07_demoLine/ApplePencil.png" alt="applepencil">
      </div>
    </section>
  </div>
</template>


<script>
import p07_demo_nav from "@/components/p07_demo_nav.vue";
export default {
    components: {
    p07_demo_nav
    }
}
</script>